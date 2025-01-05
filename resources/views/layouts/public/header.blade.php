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
                        <span class="whitespace-nowrap flex justify-center items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Profil
                        </span>
                    </a>
                    <span class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="whitespace-nowrap p-0 flex justify-center items-center gap-1" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                Logga ut</button>
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
<div class="border-t border-b border-cyan-900 bg-slate-50 py-3">
    <ul class="flex justify-center gap-4">
        <li><a href="{{ route('index') }}" class="hover:text-cyan-800 @if(request()->routeIs('index')) text-cyan-800 @endif">Dashboard</a></li>
        <li><a href="{{ route('groups.index') }}" class="hover:text-cyan-800 @if(request()->routeIs('groups.index')) text-cyan-800 @endif">Groups</a></li>
        <li>Friends</li>
        <li>Tools</li>
    </ul>
</div>
