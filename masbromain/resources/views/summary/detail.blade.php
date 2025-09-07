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
</head>

<body class="bg-[#fff5f5] text-white min-h-screen" style="font-family: 'Poppins', sans-serif;">
    <div class="max-w-sm mx-auto min-h-screen">

        <!-- Header -->
        <x-header/>

        <div class="px-6 py-4">
            <h3 class="text-2xl font-bold mb-6 text-[#f32e24] text-center pt-3">SUM<span
                    class="text-[#f35124]">MARRY</span></h3>

            <h2 class="text-xl font-bold text-[#f32e24] mb-1 text-center">Entry Detail</h2>

            <div class="max-w-lg mx-auto p-4">
                <!-- Filter Form -->
                <form method="GET" class="space-y-4">
                    <!-- Date Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Filter by Date</label>
                        <select name="filter" id="dateFilter" class="w-full rounded-lg p-2 text-black">
                            <option value="today" {{ $filter=='today'?'selected':'' }}>Hari Ini</option>
                            <option value="week" {{ $filter=='week'?'selected':'' }}>Minggu Ini</option>
                            <option value="month" {{ $filter=='month'?'selected':'' }}>Bulan Ini</option>
                            <option value="custom" {{ $filter=='custom'?'selected':'' }}>Custom</option>
                        </select>
                    </div>

                    <!-- Custom Date Inputs -->
                    <div id="customDateInputs" class="{{ $filter=='custom' ? '' : 'hidden' }} space-y-2">
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-lg p-2 text-black" placeholder="Start Date">
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-lg p-2 text-black" placeholder="End Date">
                    </div>

                    <!-- Type Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Filter by Type</label>
                        <select name="type" class="w-full rounded-lg p-2 text-black">
                            <option value="all" {{ request('type')=='all'?'selected':'' }}>All</option>
                            <option value="backcheck" {{ request('type')=='backcheck'?'selected':'' }}>Backcheck</option>
                            <option value="branding" {{ request('type')=='branding'?'selected':'' }}>Branding</option>
                            <option value="infokompetitor" {{ request('type')=='infokompetitor'?'selected':'' }}>Info Kompetitor</option>
                        </select>
                    </div>

                    <!-- Apply Button -->
                    <div>
                        <button type="submit" class="w-full action-gradient text-white font-semibold rounded-lg p-2 cursor-pointer hover:scale-110 transition-transform">Apply</button>
                    </div>
                </form>

                <!-- Entries -->
                <div class="mt-6 space-y-4">
                    @foreach($entries as $index => $entry)
                        <div class="bg-white text-gray-700 rounded-lg p-4 shadow">
                            <div class="flex justify-between text-sm font-semibold mb-2">
                                <span>Entry #{{ ($entries->firstItem() + $index) }} ({{ ucfirst($entry['type']) }})</span>
                                <span>{{ $entry['datetime']->format('d M Y H:i') }}</span>
                            </div>

                            @if($entry['type'] === 'backcheck')
                                <p>Branch: {{ $entry['branch'] }} | Cluster: {{ $entry['cluster'] }} | Outlet: {{ $entry['outlet'] }}</p>
                            @elseif($entry['type'] === 'branding')
                                <p>Branch: {{ $entry['branch'] }} | Cluster: {{ $entry['cluster'] }} | Outlet: {{ $entry['outlet'] }}</p>
                                <p class="text-xs text-gray-500">Branding: {{ $entry['jenis_branding'] }}</p>
                            @elseif($entry['type'] === 'infokompetitor')
                                <p>Branch: {{ $entry['branch'] }} | Cluster: {{ $entry['cluster'] }} | Channel: {{ ucfirst($entry['channel']) }} | Kompetitor: {{ $entry['kompetitor'] }}</p>
                                <p class="text-xs text-gray-500">Promosi: {{ $entry['promosi'] }}</p>
                            @endif

                            <div class="text-right mt-3">
                                <a href="{{ route('summary.detail', [$entry['type'], $entry['id']]) }}"
                                class="text-[#f32e24] font-semibold text-sm">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $entries->appends(request()->query())->links() }}
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('summary.index') }}" class="text-[#f32e24] font-semibold">← Back</a>
            </div>
        </div>

        <x-footer />

        <!-- Toggle Custom Date Inputs -->
        <script>
            const dateFilter = document.getElementById('dateFilter');
            const customInputs = document.getElementById('customDateInputs');

            dateFilter.addEventListener('change', function() {
                if(this.value === 'custom') {
                    customInputs.classList.remove('hidden');
                } else {
                    customInputs.classList.add('hidden');
                }
            });
        </script>
    </div>

</body>
</html>
