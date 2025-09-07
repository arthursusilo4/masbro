<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 font-medium text-sm text-green-400 bg-green-400/10 border border-green-400/20 rounded-lg p-3">
            {{ session('status') }}
        </div>
    @endif

    <!-- Login Title -->
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-white mb-1">Data telah disimpan</h3>
        <p class="text-gray-300">Silahkan kembali ke menu utama</p>
    </div>

    <a href="/">
        <!-- Buttons -->
        <div class="space-y-4">
            <button type="submit"
                class="w-full action-gradient-revert text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#F36F24] focus:ring-offset-2 focus:ring-offset-transparent shadow-lg">
                Kembali ke Home
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
        <a/>
</x-guest-layout>
