<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 font-medium text-sm text-green-400 bg-green-400/10 border border-green-400/20 rounded-lg p-3">
            {{ session('status') }}
        </div>
    @endif

    <!-- login message -->
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-white mb-1">Pilih Jabatan</h3>
        <p class="text-gray-300">Jabatan untuk Cluster {{ $user->cluster_id ? $user->cluster->name : '-' }}</p>
    </div>

    <form method="POST" action="{{ route('post-login.store') }}" class="space-y-4">
        @csrf

        @foreach($jabatans as $jabatan)
            <label class="flex items-center p-3 bg-yellow-500/20 rounded-lg cursor-pointer hover:bg-yellow-600/50">
                <input type="radio" name="jabatan_id" value="{{ $jabatan->id }}" class="mr-3" required>
                <span class="text-white">{{ $jabatan->name }}</span>
            </label>
        @endforeach

        @error('jabatan_id')
            <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
        @enderror

        <div class="mt-6">
            <button type="submit"
                class="w-full action-gradient-revert text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#F36F24] focus:ring-offset-2 focus:ring-offset-transparent shadow-lg">
                Lanjutkan
            </button>
        </div>
    </form>
</x-guest-layout>
