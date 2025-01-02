<nav class="bg-slate-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('index') }}"><label class="text-xl font-semibold">PayShareApp</label></a>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    @if(Auth::user()->is_admin)
                    <a class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group" href="{{route('admin.index')}}">
                        Admin
                    </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="whitespace-nowrap"><i class="ph ph-user mr-2"></i>Profil</span>
                    </a>
                    <span class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="whitespace-nowrap p-0" type="submit"><i class="ph ph-sign-out mr-2"></i>Logga ut</button>
                        </form>
                    </span>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</nav>
