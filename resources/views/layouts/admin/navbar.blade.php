<!-- Sidebar Toggle Button (Hamburger Menu) -->
<button id="sidebar-toggle" aria-controls="logo-sidebar" aria-expanded="false" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

<!-- Sidebar -->
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
        <!-- Close Button (only visible on mobile) -->
        <button id="sidebar-close" aria-label="Close sidebar" type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 sm:hidden">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6.293 4.293a1 1 0 011.414 0L10 6.586l2.293-2.293a1 1 0 111.414 1.414L11.414 8l2.293 2.293a1 1 0 11-1.414 1.414L10 9.414l-2.293 2.293a1 1 0 11-1.414-1.414L8.586 8 6.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>

        <a href="{{ route('admin.index') }}" class="flex items-center ps-2.5 mb-5">
            <span class="self-center text-xl font-semibold whitespace-nowrap">{{ 'Admin' ?? config('app.name', 'Laravel') }}</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li><a href="{{ route('admin.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-gauge mr-2"></i><span class="whitespace-nowrap">Dashboard</span></a></li>

            <li><a href="{{ route('admin.blog.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-article mr-2"></i><span class="whitespace-nowrap">Blog</span></a></li>

            <li><a href="{{ route('admin.bookings.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-calendar-check mr-2"></i><span class="whitespace-nowrap">Bokning</span></a></li>

            <li><a href="{{ route('admin.products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-package mr-2"></i><span class="whitespace-nowrap">Produkter</span></a></li>

            <li><a href="{{ route('admin.categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-squares-four mr-2"></i><span class="whitespace-nowrap">Kategorier</span></a></li>

            <li><a href="{{ route('admin.orders.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-package mr-2"></i><span class="whitespace-nowrap">Ordrar</span></a></li>

            {{-- <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
            <i class="ph ph-tag mr-2"></i><span class="whitespace-nowrap">Inventory *</span></a></li> --}}

            {{-- <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-tag mr-2"></i><span class="whitespace-nowrap">Rabattkoder *</span></a></li> --}}

            <li><a href="{{ route('admin.customers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-users-three mr-2"></i><span class="whitespace-nowrap">Kunder</span></a></li>

            {{-- <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-credit-card mr-2"></i><span class="whitespace-nowrap">Betalningsmetoder *</span></a></li> --}}

            {{-- <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-truck mr-2"></i><span class="whitespace-nowrap">Leveransmetoder *</span></a></li> --}}

            {{-- <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-coins mr-2"></i><span class="whitespace-nowrap">Lojalitetsprogram *</span></a></li> --}}

            {{-- <li><a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-chart-line mr-2"></i><span class="whitespace-nowrap">Försäljningsstatistik *</span></a></li> --}}
            <li><a href="{{ route('admin.filemanager.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-folder mr-2"></i><span class="whitespace-nowrap">Filemanager</span></a></li>

            <li><a href="{{ route('admin.settings.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-gear mr-2"></i><span class="whitespace-nowrap">Inställningar</span></a></li>
        </ul>
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
            <li><a href="{{ route('admin.profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-user mr-2"></i><span class="whitespace-nowrap">Profil</span></a></li>

            <li><a href="{{ route('index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <i class="ph ph-plant mr-2"></i><span class="whitespace-nowrap">Go to public</span></a></li>

            <li><span class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="whitespace-nowrap p-0" type="submit">
                        <i class="ph ph-sign-out mr-2"></i></i>Logga ut</button>
                </form>
            </span></li>
        </ul>
    </div>
</aside>

<!-- JavaScript for Sidebar Toggle and Close Button -->
<script>
    const sidebar = document.getElementById('logo-sidebar');
    const toggleButton = document.getElementById('sidebar-toggle');
    const closeButton = document.getElementById('sidebar-close');

    // Toggle the sidebar visibility when clicking the toggle button
    toggleButton.addEventListener('click', () => {
        const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
        sidebar.classList.toggle('-translate-x-full');
        toggleButton.setAttribute('aria-expanded', !isExpanded);
    });

    // Close the sidebar when clicking the close button inside the sidebar
    closeButton.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        toggleButton.setAttribute('aria-expanded', 'false');
    });
</script>
