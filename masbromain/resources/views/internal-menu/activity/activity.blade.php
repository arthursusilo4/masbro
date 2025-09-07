<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASBRO - ACTIVITY</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .action-gradient {
            background: linear-gradient(135deg, #e61e2b 2%, #f36f24 80%);
        }
    </style>
</head>

<body class="bg-[#fff5f5] text-white min-h-screen">
    <div class="max-w-sm mx-auto min-h-screen">

        <x-header2 />

        <div class="px-6 py-4">
            <h3 class="text-2xl font-bold mb-4 text-[#f32e24] text-center pt-3">ACTI<span
                    class="text-[#f35124]">VITY</span></h3>

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

            <form method="POST" action="{{ route('aktivitas.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Branch -->
                <label class="block text-lg font-medium text-[#f32e24] mb-2">Bra<span class="text-[#f35124]">nch</span></label>
                <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                <input type="text" value="{{ $branch->name }}"
                    class="w-full rounded-lg p-1 border border-gray-300 bg-gray-100 text-gray-600" disabled>

                <!-- Cluster -->
                <label class="block text-lg font-medium text-[#f32e24] mb-2">Clus<span class="text-[#f35124]">ter</span></label>
                @php
                    $userCluster = $branch->clusters->firstWhere('id', $userClusterId);
                @endphp
                <input type="hidden" name="cluster_id" value="{{ $userCluster?->id }}">
                <input type="text" value="{{ $userCluster?->name }}"
                    class="w-full rounded-lg p-1 border border-gray-300 bg-gray-100 text-gray-600" disabled>

                <!-- Kota/Kabupaten -->
                <label class="block text-lg font-medium text-[#f32e24]">Kota/Kabupaten</label>
                <select name="kota_kabupaten_id" id="kota" class="w-full rounded-lg p-1 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" required>
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                </select>

                <!-- Kecamatan -->
                <label class="block text-lg font-medium text-[#f32e24]">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan" class="w-full rounded-lg p-1 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>

                <!-- Jenis Activity -->
                <div class="space-y-4">
                    @foreach ($jenisActivities as $ja)
                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="jenis_activity_id" value="{{ $ja->id }}" class="activity-radio">
                                <span class="text-gray-700">{{ $ja->name }}</span>
                            </label>
                            <div id="activityFields{{ $ja->id }}" class="hidden ml-6 mt-2 space-y-2">
                                <input type="text"
                                    name="activity_name"
                                    placeholder="{{ $ja->id == 1
                                        ? 'Jumlah ' . str_replace('Temu', '', $ja->name)
                                        : 'Nama ' . str_replace('Visit', '', $ja->name) }}"
                                    class="w-full rounded-lg p-1 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                    disabled>
                                <textarea name="activity_detail" placeholder="Detail {{ $ja->name }}"
                                    class="w-full rounded-lg p-1 border border-gray-300 text-gray-600 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                                    disabled></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>


                <button type="submit"
                    class="w-full action-gradient text-white rounded-lg p-3 font-bold hover:scale-105 transition">
                    Simpan
                </button>
            </form>
        </div>

        <script>
        const userCluster = @json($branch->clusters->firstWhere('id', $userClusterId));

        const kotaSelect = document.getElementById('kota');
        const kecamatanSelect = document.getElementById('kecamatan');

        function loadKota() {
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';

            if (userCluster && userCluster.kota_kabupaten) {
                userCluster.kota_kabupaten.forEach(k => {
                    kotaSelect.innerHTML += `<option value="${k.id}">${k.name}</option>`;
                });
            }
        }

        kotaSelect.addEventListener('change', function() {
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            const kota = userCluster?.kota_kabupaten.find(k => k.id == this.value);

            if (kota) {
                kota.kecamatan.forEach(kec => {
                    kecamatanSelect.innerHTML += `<option value="${kec.id}">${kec.name}</option>`;
                });
            }
        });

        document.addEventListener('DOMContentLoaded', loadKota);

        document.querySelectorAll('.activity-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                // hide + disable all
                document.querySelectorAll('[id^="activityFields"]').forEach(div => {
                    div.classList.add('hidden');
                    div.querySelectorAll('input, textarea').forEach(el => el.disabled = true);
                });

                // show + enable selected
                let target = document.getElementById('activityFields' + this.value);
                target.classList.remove('hidden');
                target.querySelectorAll('input, textarea').forEach(el => el.disabled = false);
            });
        });
        </script>
        <!-- footer -->
        <x-footer />
    </div>

</body>

</html>
