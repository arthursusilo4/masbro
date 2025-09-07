<!-- header -->
<div class="action-gradient flex justify-between items-center px-6 py-8 text-sm text-gray-400 h-20">
    <!-- tombol home -->
    <a href="/">
        <button class="bg-[#e61e2b] rounded-lg p-2 hover:bg-[#b91924] transition-colors cursor-pointer hover:scale-110">
            <img src="{{ asset('img/home.svg') }}" alt="backcheck" class="w-6 h-6" />
        </button>
    </a>

    <!-- simerah -->
    <a href="/">
        <h2 class="text-white font-extrabold text-xl cursor-pointer hover:scale-110 transition-transform">MASBRO</h2>
    </a>

    <!-- logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="bg-[#F36F24] rounded-lg p-2 hover:bg-[#e55a1a] transition-colors cursor-pointer hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
        </button>
    </form>
</div>
