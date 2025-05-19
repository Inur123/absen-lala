<!DOCTYPE html>
<html lang="en" x-data="{
    sidebarOpen: window.innerWidth >= 1024,
    absensiOpen: false,
    showAddModal: false,
    showEditModal: false,

    editData: {},
    showLogoutModal: false,
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    },
}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin System')</title>
    <link rel="icon" href="{{ asset('images/logo-lala.png') }}" type="image/x-icon" />
    <meta property="og:title" content="lala25.zainur.my.id - Sistem Absensi Latin Latpel PC IPNU IPPNU Magetan" />
    <meta property="og:description" content="Sistem Absensi LATIN-LATPEL untuk PC IPNU IPPNU Magetan" />
    <meta property="og:url" content="https://lala25.zainur.my.id/login" />
    <meta property="og:type" content="website" />
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
