<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMERAH - Info Kompetitor</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#fff5f5] text-white min-h-screen">
    <div class="max-w-sm mx-auto min-h-screen">

        <!-- header -->
        <x-header2 />

        <div class="px-6 py-4">
            <h3 class="text-2xl font-bold mb-4 text-[#f32e24] text-center pt-3">INFO<span
                    class="text-[#f35124]">KOMPETITOR</span></h3>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    <ul>
                        <li>Data Berhasil Tersimpan</li>
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('infokompetitor.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- Branch -->
                <label class="block text-md font-medium text-[#f32e24] mb-2">Bra<span class="text-[#f35124]">nch</span></label>
                <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                <input type="text" value="{{ $branch->name }}"
                    class="w-full rounded-lg p-1 border border-gray-300 bg-gray-100 text-gray-600" disabled>

                <!-- Cluster -->
                <label class="block text-md font-medium text-[#f32e24] mb-2">Clus<span class="text-[#f35124]">ter</span></label>
                @php
                    $userCluster = $branch->clusters->firstWhere('id', $userClusterId);
                @endphp
                <input type="hidden" name="cluster_id" value="{{ $userCluster?->id }}">
                <input type="text" value="{{ $userCluster?->name }}"
                    class="w-full rounded-lg p-1 border border-gray-300 bg-gray-100 text-gray-600" disabled>

                <!-- Kota/Kabupaten -->
                <label class="block text-md font-medium text-[#f32e24] mb-2">Kota/<span class="text-[#f35124]">Kabupaten</span></label>
                <select name="kota_kabupaten_id" id="kota"
                    class="w-full rounded-lg p-1 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    required>
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                </select>

                <!-- Kecamatan -->
                <label class="block text-md font-medium text-[#f32e24] mb-2">Kecam<span class="text-[#f35124]">atan</span></label>
                <select name="kecamatan_id" id="kecamatan"
                    class="w-full rounded-lg p-1 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>

                <!-- Channel -->
                <label for="channel" class="block text-md font-medium text-[#f32e24] mb-2">Chan<span
                        class="text-[#f35124]">nel</span></label>
                <select name="channel" id="channelSelect" class="w-full rounded-lg p-1 text-gray-700 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" required>
                    <option value="">-- Pilih Channel --</option>
                    <option value="outlet">Outlet</option>
                    <option value="non_outlet">Non Outlet</option>
                </select>

                <!-- Outlet-only fields -->
                <div id="outletFields" class="hidden mt-3">
                    <label for="idoutlet" class="block text-md font-medium text-[#f32e24] mb-2">ID <span
                        class="text-[#f35124]">Outlet</span></label>
                    <input type="number" name="outlet_id" placeholder="ID Outlet" class="w-full rounded-lg p-1 text-gray-700 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">

                    <label for="namaoutlet" class="block text-md font-medium text-[#f32e24] mb-2 mt-3">Nama <span
                        class="text-[#f35124]">Outlet</span></label>
                    <input type="text" name="outlet_name" placeholder="Nama Outlet" class="w-full rounded-lg p-1 text-gray-700 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                </div>

                <!-- Kompetitor (radio) -->
                <label for="kompetitor" class="block text-md font-medium text-[#f32e24] mb-2">Kompe<span
                        class="text-[#f35124]">titor</span></label>
                <div class="space-y-2">
                    @foreach ($kompetitors as $k)
                        @if($k->id != 1)
                            <div class="kompetitor-option">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="kompetitor_id" value="{{ $k->id }}" class="text-[#f32e24] focus:ring-[#f32e24] kompetitor-radio" required>
                                    <span class="text-gray-700">{{ $k->name }}</span>
                                </label>
                                <div id="promoContainer-{{ $k->id }}" class="hidden ml-6 mt-2"></div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Hidden GPS -->
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <button type="submit"
                    class="w-full action-gradient rounded-lg p-3 text-white font-bold cursor-pointer hover:scale-110 transition-transform">Simpan</button>
            </form>
        </div>

        <script>
        const userCluster = @json($userCluster);

        const kotaSelect = document.getElementById('kota');
        const kecamatanSelect = document.getElementById('kecamatan');

        // Populate Kota langsung dari cluster user
        function loadKota() {
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            if (userCluster && userCluster.kota_kabupaten) {
                userCluster.kota_kabupaten.forEach(k => {
                    kotaSelect.innerHTML += `<option value="${k.id}">${k.name}</option>`;
                });
            }
        }

        kotaSelect.addEventListener('change', function () {
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            const kota = userCluster?.kota_kabupaten.find(k => k.id == this.value);

            if (kota) {
                kota.kecamatan.forEach(kec => {
                    kecamatanSelect.innerHTML += `<option value="${kec.id}">${kec.name}</option>`;
                });
            }
        });

        // Load on page ready
        document.addEventListener('DOMContentLoaded', loadKota);
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.querySelector("form");
                const latitudeInput = document.getElementById("latitude");
                const longitudeInput = document.getElementById("longitude");

                function requestLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                latitudeInput.value = position.coords.latitude;
                                longitudeInput.value = position.coords.longitude;
                            },
                            function(error) {
                                alert("⚠️ Harus Kasi Ijin GPS buat lanjut. Tolong kasi ijin ya !");
                                requestLocation();
                            }
                        );
                    } else {
                        alert("Geolocation is not supported by this browser.");
                    }
                }

                // Run immediately on page load
                requestLocation();

                // Prevent form submission if GPS not allowed
                form.addEventListener("submit", function(e) {
                    if (!latitudeInput.value || !longitudeInput.value) {
                        e.preventDefault();
                        alert("❌ Ga Boleh Lanjut tanpa ijin GPS");
                        requestLocation();
                    }
                });
            });
            const promos = @json($promos);
            const channelSelect = document.getElementById('channelSelect');
            const outletFields = document.getElementById('outletFields');

            function renderPromos() {
                const selectedKompetitor = document.querySelector('.kompetitor-radio:checked');
                if (!selectedKompetitor) return;

                // Hide all promo containers first
                document.querySelectorAll('[id^="promoContainer-"]').forEach(container => {
                    container.classList.add('hidden');
                    container.innerHTML = "";
                });

                // Get the container for the selected kompetitor
                const promoContainer = document.getElementById(`promoContainer-${selectedKompetitor.value}`);
                if (!promoContainer) return;

                promoContainer.classList.remove('hidden');

                // Add promo label
                const promoLabel = document.createElement('label');
                promoLabel.className = 'block text-md font-medium text-[#f32e24] mb-2';
                promoLabel.innerHTML = 'Jenis <span class="text-[#f35124]">Promosi</span>';
                promoContainer.appendChild(promoLabel);

                let filteredPromos = [];
                const channel = channelSelect.value;

                if (channel === "outlet") {
                    filteredPromos = promos.filter(p => (p.id >= 1 && p.id <= 5) || p.id == 9);
                    outletFields.classList.remove("hidden");
                } else if (channel === "non_outlet") {
                    filteredPromos = promos.filter(p => p.id >= 6 && p.id <= 9);
                    outletFields.classList.add("hidden");
                } else {
                    outletFields.classList.add("hidden");
                }

                filteredPromos.forEach(p => {
                    const promoDiv = document.createElement('div');
                    promoDiv.className = 'flex flex-col space-y-2';

                    const promoLabel = document.createElement('label');
                    promoLabel.className = 'flex items-center space-x-2';

                    const promoCheckbox = document.createElement('input');
                    promoCheckbox.type = 'checkbox';
                    promoCheckbox.name = 'promotion_ids[]';
                    promoCheckbox.value = p.id;
                    promoCheckbox.className = 'promo-checkbox text-[#f32e24] focus:ring-[#f32e24]';

                    const promoName = document.createElement('span');
                    promoName.className = 'text-black';
                    promoName.textContent = p.name;

                    promoLabel.appendChild(promoCheckbox);
                    promoLabel.appendChild(promoName);
                    promoDiv.appendChild(promoLabel);

                    const photoDiv = document.createElement('div');
                    photoDiv.id = `photoForPromo${p.id}`;
                    photoDiv.className = 'hidden ml-6';

                    const photoLabel = document.createElement('label');
                    photoLabel.className = 'block text-sm text-gray-700 mb-1';
                    photoLabel.textContent = `Foto Promosi (${p.name})`;

                    const photoInput = document.createElement('input');
                    photoInput.type = 'file';
                    photoInput.name = `promo_photos[${p.id}]`;
                    photoInput.accept = 'image/*';
                    photoInput.capture = 'environment';
                    photoInput.className = 'w-full text-black border rounded p-2';

                    photoDiv.appendChild(photoLabel);
                    photoDiv.appendChild(photoInput);
                    promoDiv.appendChild(photoDiv);

                    promoContainer.appendChild(promoDiv);

                    // Add event listener for the checkbox
                    promoCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            photoDiv.classList.remove('hidden');
                        } else {
                            photoDiv.classList.add('hidden');
                        }
                    });
                });

                // toggle photo field when checkbox is clicked
                document.querySelectorAll(".promo-checkbox").forEach(checkbox => {
                    checkbox.addEventListener("change", function () {
                        const target = document.getElementById("photoForPromo" + this.value);
                        if (target) {
                            if (this.checked) {
                                target.classList.remove("hidden");
                            } else {
                                target.classList.add("hidden");
                            }
                        }
                    });
                });
            }

            // Listen for both channel and kompetitor changes
            channelSelect.addEventListener("change", renderPromos);
            document.querySelectorAll('.kompetitor-radio').forEach(radio => {
                radio.addEventListener('change', renderPromos);
            });
        </script>

        <!-- footer -->
        <x-footer />
    </div>

</body>

</html>
