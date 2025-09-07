<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMERAH - Branding</title>
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
            <h3 class="text-2xl font-bold mb-4 text-[#f32e24] text-center pt-3">BRAN<span
                    class="text-[#f35124]">DING</span></h3>

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

            <form method="POST" action="{{ route('branding.store') }}" enctype="multipart/form-data" class="space-y-4">
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
                <input type="number" name="outlet_id" placeholder="ID Outlet" class="w-full rounded-lg p-2 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                    required>
                <label for="nama outlet" class="block text-md font-medium text-[#f32e24] mb-2">Nama <span
                        class="text-[#f35124]">Outlet</span></label>
                <input type="text" name="outlet_name" placeholder="Nama Outlet"
                    class="w-full rounded-lg p-2 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" required>

                <!-- Jenis Branding -->
                <label for="nama outlet" class="block text-md font-medium text-[#f32e24] mb-2">Jenis <span
                        class="text-[#f35124]">Label</span></label>
                <div class="space-y-2">
                    @foreach ($jenisBranding as $jb)
                        <div class="flex flex-col space-y-2">
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="jb{{ $jb->id }}" name="jenis_branding[]"
                                    value="{{ $jb->id }}"
                                    class="branding-checkbox text-[#f32e24] focus:ring-[#f32e24]">
                                <label for="jb{{ $jb->id }}" class="text-gray-700">{{ $jb->name }}</label>
                            </div>

                            <!-- hidden photo upload -->
                            <div id="photoSection{{ $jb->id }}" class="hidden ml-6">
                                <label class="block text-sm text-gray-700 mb-1">Upload Foto untuk
                                    {{ $jb->name }}</label>
                                <input type="file" name="photos[{{ $jb->id }}]" accept="image/*" multiple
                                    class="w-full text-gray-700 border rounded p-2">
                            </div>
                        </div>
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

            document.querySelectorAll('.branding-checkbox').forEach(cb => {
                cb.addEventListener('change', function() {
                    const section = document.getElementById('photoSection' + this.value);
                    if (this.checked) {
                        section.classList.remove('hidden');
                    } else {
                        section.classList.add('hidden');
                    }
                });
            });
        </script>

        <!-- footer -->
        <x-footer />
    </div>

</body>

</html>
