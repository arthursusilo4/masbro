<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMERAH - Summary</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <style>
        /* Search input focus styles */
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(243, 46, 36, 0.1);
            border-color: #f32e24;
        }

        /* Popup animation styles */
        .popup-overlay {
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .popup-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .popup-overlay:not(.hidden) {
            opacity: 1;
            visibility: visible;
        }

        .popup-content {
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .popup-overlay:not(.hidden) .popup-content {
            transform: scale(1) translateY(0);
        }

        /* Member card hover effect */
        .member-card {
            transition: all 0.2s ease;
        }

        .member-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(243, 46, 36, 0.15);
        }

        /* No results message */
        .no-results {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-[#fff5f5] text-white min-h-screen" style="font-family: 'Poppins', sans-serif;">
    <div class="max-w-sm mx-auto min-h-screen">

        <!-- Header -->
        <x-header2 />

        <div class="px-6 py-4">
            <h3 class="text-2xl font-bold mb-4 text-[#f32e24] text-center pt-3">SUM<span
                    class="text-[#f35124]">MARRY</span></h3>

        </div>

        <div class="px-6 space-y-4">
            <h3 class="text-lg text-center font-bold text-[#f32e24] mb-1">Cluster Members</h3>

            <!-- Search Input -->
            <div class="mb-4">
                <div class="relative">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search member names..."
                        class="search-input w-full px-4 py-3 pl-10 text-gray-700 bg-white rounded-lg border-2 border-gray-200 focus:outline-none focus:ring-0 transition-all duration-200"
                        oninput="searchMembers()"
                    />
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- name controller --}}
            <div class="space-y-3 mb-6" id="membersList">
                <p class="text-gray-500 text-sm text-center">Tekan Nama untuk melihat detail kinerja</p>
                @foreach($users->take(5) as $u)
                    <div class="member-card bg-white rounded-lg p-4 shadow text-gray-700" data-name="{{ strtolower($u->name) }}">
                        <button
                            class="w-full text-left font-semibold text-[#f32e24]"
                            onclick="openPopup({{ $u->id }}, '{{ $u->name }}', {{ $u->backchecks_count }}, {{ $u->brandings_count }}, {{ $u->infokompetitors_count }})">
                            {{ strtoupper($u->name) }}
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($users->count() > 5)
            <div class="flex justify-center items-center space-x-2 my-4">
                @foreach(range(1, ceil($users->count() / 5)) as $page)
                    <button
                        onclick="paginateMembers({{ $page }})"
                        class="paginate-btn w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-colors duration-200
                        {{ $page === 1 ? 'bg-[#f32e24] text-white' : 'bg-white text-[#f32e24] hover:bg-gray-100' }}"
                        data-page="{{ $page }}">
                        {{ $page }}
                    </button>
                @endforeach
            </div>
            @endif

            <script>
                const allMembers = [
                    @foreach($users as $u)
                    {
                        id: {{ $u->id }},
                        name: '{{ $u->name }}',
                        backchecks_count: {{ $u->backchecks_count }},
                        brandings_count: {{ $u->brandings_count }},
                        infokompetitors_count: {{ $u->infokompetitors_count }},
                        lowerName: '{{ strtolower($u->name) }}'
                    },
                    @endforeach
                ];

                function paginateMembers(page) {
                    const membersList = document.getElementById('membersList');
                    membersList.innerHTML = '';

                    const startIndex = (page - 1) * 5;
                    const paginatedMembers = allMembers.slice(startIndex, startIndex + 5);

                    paginatedMembers.forEach(member => {
                        const memberCard = document.createElement('div');
                        memberCard.className = 'member-card bg-white rounded-lg p-4 shadow text-gray-700';
                        memberCard.setAttribute('data-name', member.lowerName);

                        memberCard.innerHTML = `
                            <button
                                class="w-full text-left font-semibold text-[#f32e24]"
                                onclick="openPopup(${member.id}, '${member.name}', ${member.backchecks_count}, ${member.brandings_count}, ${member.infokompetitors_count})">
                                ${member.name.toUpperCase()}
                            </button>
                        `;

                        membersList.appendChild(memberCard);
                    });

                    // Update active pagination button
                    document.querySelectorAll('.paginate-btn').forEach(btn => {
                        btn.classList.remove('bg-[#f32e24]', 'text-white');
                        btn.classList.add('bg-white', 'text-[#f32e24]', 'hover:bg-gray-100');
                    });

                    const activeBtn = document.querySelector(`.paginate-btn[data-page="${page}"]`);
                    if(activeBtn) {
                        activeBtn.classList.remove('bg-white', 'text-[#f32e24]', 'hover:bg-gray-100');
                        activeBtn.classList.add('bg-[#f32e24]', 'text-white');
                    }
                }

                function searchMembers() {
                    const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
                    const noResults = document.getElementById('noResults');
                    let visibleCount = 0;

                    // Show all paginated results if search is empty
                    if(searchTerm === '') {
                        paginateMembers(1);
                        return;
                    }

                    const membersList = document.getElementById('membersList');
                    membersList.innerHTML = '';

                    const filteredMembers = allMembers.filter(member =>
                        member.lowerName.includes(searchTerm)
                    );

                    filteredMembers.forEach(member => {
                        const memberCard = document.createElement('div');
                        memberCard.className = 'member-card bg-white rounded-lg p-4 shadow text-gray-700';
                        memberCard.setAttribute('data-name', member.lowerName);

                        memberCard.innerHTML = `
                            <button
                                class="w-full text-left font-semibold text-[#f32e24]"
                                onclick="openPopup(${member.id}, '${member.name}', ${member.backchecks_count}, ${member.brandings_count}, ${member.infokompetitors_count})">
                                ${member.name.toUpperCase()}
                            </button>
                        `;

                        membersList.appendChild(memberCard);
                        visibleCount++;
                    });

                    // Show/hide no results message and pagination
                    document.querySelector('.flex.justify-center.space-x-2')?.classList.add('hidden');

                    if (visibleCount === 0) {
                        noResults.classList.remove('hidden');
                    } else {
                        noResults.classList.add('hidden');
                    }
                }
            </script>

            <!-- No Results Message -->
            <div id="noResults" class="no-results hidden text-center py-8">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0118 12a8 8 0 01-2.009 5.291m-4.982 0A7.962 7.962 0 018 12a8 8 0 012.009-5.291m4.982 0A7.962 7.962 0 0016 12a8 8 0 01-2.009 5.291"></path>
                    </svg>
                    <p class="text-lg font-medium">Member tidak ditemukan</p>
                    <p class="text-sm">Tolong cari dengan kata kunci beda.</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Popup -->
        <div id="userPopup" class="popup-overlay hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="popup-content bg-white text-gray-700 rounded-xl p-6 w-80 shadow-2xl relative mx-4">
                <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition-colors duration-200 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100" onclick="closePopup()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <h3 id="popupName" class="text-lg font-bold text-[#f32e24] mb-4 pr-8"></h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Backcheck:</span>
                        <span id="popupBackcheck" class="font-semibold text-[#f32e24]"></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Branding:</span>
                        <span id="popupBranding" class="font-semibold text-[#f32e24]"></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Info Kompetitor:</span>
                        <span id="popupInfokompetitor" class="font-semibold text-[#f32e24]"></span>
                    </div>
                </div>
                <a id="popupDetailBtn" href="#"
                class="block text-center bg-[#f32e24] hover:bg-[#d12620] text-white rounded-lg py-3 font-semibold transition-colors duration-200 shadow-md">
                    View Details
                </a>
            </div>
        </div>

        <x-footer />

        <script>
        // Search functionality
        function searchMembers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const memberCards = document.querySelectorAll('.member-card');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;

            memberCards.forEach(card => {
                const memberName = card.getAttribute('data-name');
                if (memberName.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0 && searchTerm !== '') {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }

        // Enhanced popup functions
        function openPopup(userId, name, backcheck, branding, infokompetitor) {
            document.getElementById('popupName').innerText = name;
            document.getElementById('popupBackcheck').innerText = backcheck;
            document.getElementById('popupBranding').innerText = branding;
            document.getElementById('popupInfokompetitor').innerText = infokompetitor;
            document.getElementById('popupDetailBtn').href = "/user/summary/" + userId;

            const popup = document.getElementById('userPopup');
            popup.classList.remove('hidden');

            // Prevent body scroll when popup is open
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            const popup = document.getElementById('userPopup');
            popup.classList.add('hidden');

            // Restore body scroll
            document.body.style.overflow = 'auto';
        }

        // Close popup when clicking outside
        document.getElementById('userPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
        </script>
    </div>

</body>
</html>
