<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASBRO - BACKCHECK</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <style>
        .competitor-box {
            background: linear-gradient(135deg, rgba(243, 46, 36, 0.1) 0%, rgba(243, 81, 36, 0.1) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(243, 46, 36, 0.2);
        }

        .photo-item {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 8px;
            margin: 4px 0;
            display: flex;
            justify-content: between;
            align-items: center;
            font-size: 0.8rem;
            border: 1px solid rgba(243, 46, 36, 0.2);
        }

        .delete-btn {
            background: #f32e24;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 2px 6px;
            font-size: 0.7rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .delete-btn:hover {
            background: #d91e1e;
        }
    </style>
</head>

<body class="bg-[#fff5f5] text-white min-h-screen">
    <div class="max-w-sm mx-auto min-h-screen">

        <!-- header -->
        <x-header2 />

        <div class="px-6 py-4">
            <h3 class="text-2xl font-bold mb-4 text-[#f32e24] text-center pt-3">BACK<span
                    class="text-[#f35124]">CHECK</span></h3>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    <ul>
                        <li>Data Berhasil Tersimpan</li>
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('backcheck.store') }}" enctype="multipart/form-data"
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

                <!-- Outlet -->
                <label for="id outlet" class="block text-md font-medium text-[#f32e24] mb-2">ID <span
                        class="text-[#f35124]">Outlet</span></label>
                <input type="number" name="outlet_id" placeholder="ID Outlet"
                    class="w-full rounded-lg p-2 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    required>

                <label for="nama outlet" class="block text-md font-medium text-[#f32e24] mb-2">Nama <span
                        class="text-[#f35124]">Outlet</span></label>
                <input type="text" name="outlet_name" placeholder="Nama Outlet"
                    class="w-full rounded-lg p-2 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    required>

                <label for="nomor owner" class="block text-md font-medium text-[#f32e24] mb-2">Nomor <span
                        class="text-[#f35124]">Owner</span></label>
                <input type="number" name="owner_phone" placeholder="Nomor Owner"
                    class="w-full rounded-lg p-2 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    required>

                <!-- Competitor fields -->
                @foreach (['display_share' => 'Display Share', 'sales_share_perdana' => 'Sales Share Perdana', 'sales_share_renewal' => 'Sales Share Renewal'] as $field => $label)
                    <div class="competitor-box rounded-xl p-4 mb-4 mt-5">
                        <h3 class="text-lg text-center font-bold text-[#f32e24] mb-1">{{ $label }}</h3>
                        @if (in_array($field, ['sales_share_perdana', 'sales_share_renewal']))
                            <p class="text-sm text-center text-gray-500 mb-3">Weekly Ach</p>
                        @else
                            <div class="mb-3"></div>
                        @endif
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($competitors as $index => $competitor)
                                <div class="col-span-1">
                                    <!-- Image above the label -->
                                    <div class="mb-2 text-center">
                                        <img src="{{ asset('img/' . ($index + 1) . '.png') }}"
                                            alt="{{ $competitor->name }}"
                                            class="max-w-full h-16 mx-auto object-contain rounded">
                                    </div>

                                    <input type="number" name="{{ $field }}[{{ $competitor->id }}]"
                                        placeholder="Masukan Angka"
                                        class="w-full rounded-lg p-2 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Enhanced Photo Upload Sections -->
                <div class="text-center">
                    <label class="block text-md font-medium text-[#f32e24] mb-2">Foto <span
                            class="text-[#f35124]">Laporan</span></label>
                    <input type="file" name="photo_laporan" id="photo-laporan" accept="image/*"
                        class="w-full text-black bg-white rounded p-2">
                    <div id="photo-laporan-list" class="mt-2"></div>
                </div>

                <div class="text-center">
                    <label class="block text-md font-medium text-[#f32e24] mb-2">
                        Foto <span class="text-[#f35124]">Display</span>
                    </label>

                    <!-- Container for file inputs -->
                    <div id="photo-display-container">
                        <input type="file" name="photo_display[]" accept="image/*"
                            class="w-full text-black bg-white rounded p-2 mb-2">
                    </div>

                    <!-- Add more button -->
                    <button type="button" id="add-photo-display"
                        class="mt-2 px-3 py-1 grey-gradient text-white rounded-lg cursor-pointer hover:scale-110 transition-transform">
                        + Tambah Foto Display
                    </button>

                    <div id="photo-display-list" class="mt-2"></div>
                </div>

                <div class="text-center">
                    <label class="block text-md font-medium text-[#f32e24] mb-2">Foto <span
                            class="text-[#f35124]">Branding</span></label>
                    <input type="file" name="photo_branding" id="photo-branding" accept="image/*"
                        class="w-full text-black bg-white rounded p-2">
                    <div id="photo-branding-list" class="mt-2"></div>
                </div>

                <!-- Hidden GPS -->
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <a href="/post-submit">
                <button type="submit"
                    class="w-full action-gradient rounded-lg p-3 text-white font-bold cursor-pointer hover:scale-110 transition-transform">Simpan</button>
                    </a>
            </form>
        </div>

        <!-- footer -->
        <x-footer />
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

        // GPS functionality
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

            requestLocation();

            form.addEventListener("submit", function(e) {
                if (!latitudeInput.value || !longitudeInput.value) {
                    e.preventDefault();
                    alert("❌ Ga Boleh Lanjut tanpa ijin GPS");
                    requestLocation();
                    return;
                }
            });
        });

        // Add Photo Display functionality
        document.getElementById('add-photo-display').addEventListener('click', function() {
            const container = document.getElementById('photo-display-container');

            // Create wrapper div for input + remove button
            const wrapper = document.createElement('div');
            wrapper.className = 'mb-2';

            // Create a flex container inside the wrapper for proper alignment
            const flexContainer = document.createElement('div');
            flexContainer.className = 'flex items-center gap-2';

            // Create new file input with same width as original
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'photo_display[]';
            newInput.accept = 'image/*';
            newInput.className = 'w-full text-black bg-white rounded p-2';

            // Create remove button with fixed width
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '&times;';
            removeBtn.className = 'text-red-500 text-xl font-bold px-2 py-1 hover:text-red-700 flex-shrink-0';

            removeBtn.addEventListener('click', function() {
                container.removeChild(wrapper);
            });

            // Assemble the structure
            flexContainer.appendChild(newInput);
            flexContainer.appendChild(removeBtn);
            wrapper.appendChild(flexContainer);
            container.appendChild(wrapper);
        });
    </script>
</body>

</html>
