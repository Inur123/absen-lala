<aside
    class="fixed inset-y-0 left-0 z-50 flex h-full w-64 flex-col border-r bg-background transition-transform duration-300 lg:relative lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <!-- Sidebar header -->
    <div class="flex h-14 items-center border-b px-4">
        <div
            class="flex items-center gap-2 cursor-pointer hover:bg-accent rounded-md p-1 transition-colors duration-200 w-full">
            <div class="flex h-8 w-8 items-center justify-center rounded-md text-white overflow-hidden">
                <img src="{{ asset('images/Black.png') }}" alt="Icon" class="h-8 w-8 object-contain">
            </div>

            <div>
                <p class="text-sm font-semibold">Admin System</p>
                <p class="text-xs text-muted-foreground">Management Panel</p>
            </div>
        </div>
        <button @click="toggleSidebar"
            class="ml-auto rounded-md p-1 text-muted-foreground hover:bg-accent hover:text-accent-foreground lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </button>
    </div>

    <!-- Sidebar content -->
    <div class="flex-1 overflow-auto py-2">
        <div class="px-3 py-2">
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex w-full items-center gap-3 rounded-md px-4 py-2 text-sm font-medium
        {{ request()->routeIs('dashboard') ? 'bg-gray-200 text-gray-900' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-4 w-4">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    Dashboard
                </a>



                <a href="{{ route('peserta.index') }}"
                    class="flex w-full items-center gap-3 rounded-md px-4 py-2 text-sm font-medium
        {{ request()->routeIs('peserta.*') ? 'bg-gray-200 text-gray-900' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-4 w-4">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Peserta
                </a>



                <div class="relative" x-data="{ absensiOpen: {{ (request()->routeIs('materi.*') || request()->routeIs('absensi.*')) ? 'true' : 'false' }} }">
    <button @click="absensiOpen = !absensiOpen"
        class="flex w-full items-center justify-between rounded-md px-4 py-2 text-sm font-medium
        {{ (request()->routeIs('materi.*') || request()->routeIs('absensi.*')) ? 'bg-gray-200 text-gray-900' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">

        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-4 w-4">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                <line x1="16" x2="16" y1="2" y2="6" />
                <line x1="8" x2="8" y1="2" y2="6" />
                <line x1="3" x2="21" y1="10" y2="10" />
                <path d="m9 16 2 2 4-4" />
            </svg>
            Absensi
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-4 w-4 transition-transform"
            :class="absensiOpen ? 'rotate-180' : ''">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <div x-show="absensiOpen" class="pl-4 mt-1" x-transition>
        <a href=""
            class="flex w-full items-center rounded-md px-4 py-2 text-sm
            {{ request()->routeIs('data.absensi.*') ? 'bg-gray-200 text-gray-900' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
            Data Absensi
        </a>
        <a href="{{ route('materi.index') }}"
            class="flex w-full items-center rounded-md px-4 py-2 text-sm
            {{ request()->routeIs('materi.*') ? 'bg-gray-200 text-gray-900' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
            Buat Absensi
        </a>
        <a href="{{ route('absensi.index') }}"
            class="flex w-full items-center rounded-md px-4 py-2 text-sm
            {{ request()->routeIs('absensi.*') ? 'bg-gray-200 text-gray-900' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
            Scan Absen
        </a>
    </div>
</div>

            </div>
        </div>
    </div>

    <!-- Sidebar footer -->
    <div class="mt-auto border-t p-4">
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-black text-white">
                <span class="text-sm font-medium">
                    {{ collect(explode(' ', Auth::user()->name))->take(2)->map(fn($word) => strtoupper(Str::substr($word, 0, 1)))->implode('') }}
                </span>
            </div>

            <div>
                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>

            </div>
            <button @click="showLogoutModal = true"
                class="ml-auto rounded-full p-1 text-muted-foreground hover:bg-accent hover:text-accent-foreground cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-4 w-4">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
            </button>
        </div>
    </div>
</aside>
