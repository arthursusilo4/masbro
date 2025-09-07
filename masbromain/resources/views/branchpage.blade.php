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
<body>
    <div id="template1" class="template min-h-screen bg-gray-900 p-6 hidden">
        <!-- Header -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 mb-6 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Field Monitor - MASBRO</h1>
                    <p class="text-gray-400 mt-1">Real-time infrastructure monitoring</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 bg-gray-700 px-3 py-2 rounded-lg">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-green-400 text-sm font-medium">ONLINE</span>
                    </div>
                    <button class="bg-gray-700 hover:bg-gray-600 p-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- System Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-blue-500/50 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-blue-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 3V1H7v2H5c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V5c0-1.11-.89-2-2-2h-2V1h-2v2H9z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400">STATUS</div>
                        <div class="text-xs text-green-400 font-medium">NORMAL</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-white mb-1">67%</div>
                <div class="text-gray-400 text-sm mb-3">CPU Usage</div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 67%"></div>
                </div>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-yellow-500/50 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-yellow-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 2v20l8-8 8 8V2H4z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400">STATUS</div>
                        <div class="text-xs text-yellow-400 font-medium">WARNING</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-white mb-1">84%</div>
                <div class="text-gray-400 text-sm mb-3">Memory</div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 84%"></div>
                </div>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-green-500/50 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-green-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400">STATUS</div>
                        <div class="text-xs text-green-400 font-medium">NORMAL</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-white mb-1">45%</div>
                <div class="text-gray-400 text-sm mb-3">Storage</div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 45%"></div>
                </div>
            </div>

            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-purple-500/50 transition-colors">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-purple-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3c-1.65-1.66-4.34-1.66-6 0zm-4-4l2 2c2.76-2.76 7.24-2.76 10 0l2-2C15.14 9.14 8.87 9.14 5 13z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400">STATUS</div>
                        <div class="text-xs text-green-400 font-medium">ACTIVE</div>
                    </div>
                </div>
                <div class="text-2xl font-bold text-white mb-1">156</div>
                <div class="text-gray-400 text-sm mb-3">Network (Mbps)</div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-purple-500 h-2 rounded-full animate-pulse" style="width: 78%"></div>
                </div>
            </div>
        </div>

        <!-- Monitoring Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Performance Metrics</h3>
                <div class="h-48 bg-gray-700/50 rounded-lg flex items-center justify-center">
                    <div class="text-gray-400">Real-time monitoring chart</div>
                </div>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">System Logs</h3>
                <div class="space-y-3 font-mono text-sm">
                    <div class="flex items-center gap-3">
                        <span class="text-green-400">[INFO]</span>
                        <span class="text-gray-300">System boot completed successfully</span>
                        <span class="text-gray-500 ml-auto">14:32:01</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-yellow-400">[WARN]</span>
                        <span class="text-gray-300">High memory usage detected</span>
                        <span class="text-gray-500 ml-auto">14:31:45</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-green-400">[INFO]</span>
                        <span class="text-gray-300">Database connection established</span>
                        <span class="text-gray-500 ml-auto">14:31:32</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-blue-400">[DEBUG]</span>
                        <span class="text-gray-300">Cache refresh completed</span>
                        <span class="text-gray-500 ml-auto">14:31:18</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
