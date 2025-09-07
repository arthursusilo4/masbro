<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 font-medium text-sm text-green-400 bg-green-400/10 border border-green-400/20 rounded-lg p-3">
            {{ session('status') }}
        </div>
    @endif

    <!-- Login Title -->
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-white mb-1">MASBRO</h3>
        <p class="text-gray-300">Silakan masuk untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- NIK -->
        <div class="mb-4">
            <label for="nik" class="block font-semibold text-sm text-gray-200 mb-2">NIK</label>
            <input id="nik"
                class="block w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F36F24] focus:border-transparent transition-all duration-200 hover:bg-white/15"
                type="text" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK Anda" required
                autofocus autocomplete="username" />

            @if ($errors->has('nik'))
                <ul class="mt-2 text-sm text-red-400 space-y-1">
                    @foreach ($errors->get('nik') as $error)
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block font-semibold text-sm text-gray-200 mb-2">Password</label>
            <input id="password"
                class="block w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F36F24] focus:border-transparent transition-all duration-200 hover:bg-white/15"
                type="password" name="password" placeholder="Masukkan password Anda" required
                autocomplete="current-password" />

            @if ($errors->has('password'))
                <ul class="mt-2 text-sm text-red-400 space-y-1">
                    @foreach ($errors->get('password') as $error)
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded border-white/20 bg-white/10 text-[#F36F24] shadow-sm focus:ring-[#F36F24] focus:ring-offset-0 focus:ring-offset-transparent"
                    name="remember">
                <span class="ml-3 text-sm text-gray-300 group-hover:text-white transition-colors">Ingat saya</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="space-y-4">
            <button type="submit"
                class="w-full action-gradient-revert text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#F36F24] focus:ring-offset-2 focus:ring-offset-transparent shadow-lg">
                Masuk
            </button>
            {{--
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-sm text-gray-300 hover:text-[#F36F24] transition-colors duration-200"
                       href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                </div>
            @endif --}}
        </div>
    </form>
</x-guest-layout>
