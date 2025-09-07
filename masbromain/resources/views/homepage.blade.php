<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMERAH - TELKOMSEL</title>
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
        <x-header />

        <!-- status -->
        <div class="px-6 mb-8 pt-2">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-[#f32e24]" id="greeting">Selamat pagi,</h1>
                    <p class="text-2xl text-[#f35124] font-bold">
                        {{ strtoupper($jabatan->name ?? '') }}
                        {{ Auth::user()->name }}</p>

                </div>
                <div
                    class="w-12 h-12 flex items-center justify-center cursor-pointer hover:scale-110 transition-transform">
                    <a href="https://www.telkomsel.com/">
                        <img src="{{ asset('img/03_Telkomsel_PORTAL_T_RGB_GRADIENT.png') }}" alt="telkom" />
                    </a>
                </div>
            </div>
        </div>

        <!-- masbro logo -->
        <x-masbro />

        <!-- menu Card Grid -->
        <div class="px-6 mb-8">
            <h3 class="text-2xl font-bold text-[#f32e24] text-center mb-3">M E <span
                            class="text-[#f35124]">N U</span></h3>
            <div class="grid grid-cols-2 gap-4">
                <!-- First row: BackCheck and Branding -->
                <a
                    class="action-gradient rounded-2xl p-6 hover:bg-gray-750 transition-colors cursor-pointer group item flex flex-col items-center justify-center text-center" href="/user/backcheck">
                    <div
                        class="w-10 h-10 bg-transparent rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-blue-400 text-xl"><img src="{{ asset('img/backcheck2.svg') }}"
                                alt="backcheck" /></span>
                    </div>
                    <h4 class="font-semibold text-lg text-white">BackCheck</h4>
                </a>

                <a class="action-gradient rounded-2xl p-6 hover:bg-gray-750 transition-colors cursor-pointer group flex flex-col items-center justify-center text-center" href="/user/branding">
                    <div
                        class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-purple-400 text-xl"><img src="{{ asset('img/branding2.svg') }}"
                                alt="branding" /></span>
                    </div>
                    <h4 class="font-semibold text-lg text-white">Branding</h4>
                </a>

                <!-- Second row: Activity and InfoKompetitor -->
                <a class="action-gradient rounded-2xl p-6 hover:bg-gray-750 transition-colors cursor-pointer group flex flex-col items-center justify-center text-center" href="/user/aktivitas">
                    <div
                        class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-green-400 text-xl"><img src="{{ asset('img/activity.svg') }}"
                                alt="activity" /></span>
                    </div>
                    <h4 class="font-semibold text-lg text-white">Activities</h4>
                </a>

                <a class="action-gradient rounded-2xl p-6 hover:bg-gray-750 transition-colors cursor-pointer group flex flex-col items-center justify-center text-center" href="/user/infokompetitor">
                    <div
                        class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-red-400 text-xl"><img src="{{ asset('img/infokompetitor2.svg') }}"
                                alt="infokompetitor" /></span>
                    </div>
                    <h4 class="font-semibold text-lg text-white">Info Kompetitor</h4>
                </a>

                <!-- Third row: Summary spanning full width -->
                <a class="action-gradient rounded-2xl p-6 hover:bg-gray-750 transition-colors cursor-pointer group flex flex-col items-center justify-center text-center col-span-2" href="/user/summary">
                    <div
                        class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-yellow-400 text-xl"><img src="{{ asset('img/summaryreport2.svg') }}"
                                alt="summary" /></span>
                    </div>
                    <h4 class="font-semibold text-lg text-white">Summary</h4>
                </a>
            </div>
        </div>

        <!-- footer -->
        <x-footer />
    </div>

    <script>
        // salam dinamik sesuai jam user terkini
        function updateGreeting() {
            const now = new Date();
            const hour = now.getHours();
            const greetingElement = document.getElementById('greeting');

            let greeting;
            if (hour >= 5 && hour < 11) {
                greeting = "Selamat pagi,";
            } else if (hour >= 11 && hour < 15) {
                greeting = "Selamat siang,";
            } else if (hour >= 1 && hour < 16) {
                greeting = "Selamat siang,";
            } else {
                greeting = "Selamat sore,";
            }

            greetingElement.textContent = greeting;
        }

        // Update greeting when page loads
        document.addEventListener('DOMContentLoaded', updateGreeting);
    </script>
</body>

</html>
