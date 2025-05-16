<!DOCTYPE html>
<html lang="en" x-data="{
    darkMode: localStorage.getItem('darkMode') === 'true',
    sidebarOpen: window.innerWidth >= 1024,
    absensiOpen: false,
    showLogoutModal: false,
    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
    },
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    },
    getAttendancePercentage(item) {
        return Math.round((item.pesertaHadir / item.totalPeserta) * 100);
    },
    logout() {
        window.location.href = 'index.html';
    }
}" x-init="$watch('darkMode', val => document.documentElement.classList.toggle('dark', val))" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin System')</title>
    <link rel="icon" href="{{ asset('images/logo-lala.png') }}" type="image/x-icon">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="antialiased">
    <div class="flex h-screen overflow-hidden">
        @include('layouts.sidebar')

        <!-- Main content -->
        <div class="flex flex-1 flex-col overflow-hidden">
            @include('layouts.header')

            <!-- Content -->
            <main class="flex-1 overflow-auto p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @include('components.logout-modal')

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-background/80 backdrop-blur-sm lg:hidden"></div>
</body>

</html>
