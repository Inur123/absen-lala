@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col gap-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
            <p class="text-muted-foreground">Ringkasan sistem manajemen kegiatan.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Peserta -->
            <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-5 w-5 text-muted-foreground">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <h3 class="text-sm font-medium">Total Peserta</h3>
                </div>
                <div class="mt-3">
                    <p class="text-2xl font-bold">{{ count($pesertas) }}</p>
                    <p class="text-xs text-muted-foreground">
                        <!-- Removed the new this week counter -->
                    </p>
                </div>
                <div class="mt-4 flex items-center justify-between text-xs text-muted-foreground">
                    <div class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        <span>Laki-laki: {{ $jumlahLakiLaki }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-pink-500"></span>
                        <span>Perempuan: {{ $jumlahPerempuan }}</span>
                    </div>
                </div>
            </div>

            <!-- Total Absensi -->
            <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-5 w-5 text-muted-foreground">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                        <line x1="16" x2="16" y1="2" y2="6" />
                        <line x1="8" x2="8" y1="2" y2="6" />
                        <line x1="3" x2="21" y1="10" y2="10" />
                        <path d="m9 16 2 2 4-4" />
                    </svg>
                    <h3 class="text-sm font-medium">Total Absensi</h3>
                </div>
                <div class="mt-3">
                    <p class="text-2xl font-bold" x-text="absensiStats.total"></p>
                    <p class="text-xs text-muted-foreground">
                        <span class="text-green-500 dark:text-green-400"><span
                                x-text="absensiStats.averageAttendance"></span>%</span> rata-rata kehadiran
                    </p>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-2 text-xs text-muted-foreground">
                    <div class="flex flex-col items-center rounded-md bg-secondary p-1">
                        <span class="font-medium text-foreground" x-text="absensiStats.active"></span>
                        <span>Aktif</span>
                    </div>
                    <div class="flex flex-col items-center rounded-md bg-secondary p-1">
                        <span class="font-medium text-foreground" x-text="absensiStats.completed"></span>
                        <span>Selesai</span>
                    </div>
                    <div class="flex flex-col items-center rounded-md bg-secondary p-1">
                        <span class="font-medium text-foreground" x-text="absensiStats.upcoming"></span>
                        <span>Mendatang</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm md:col-span-2">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-5 w-5 text-muted-foreground">
                        <path d="M12 2v20" />
                        <path d="m17 5-5-3-5 3" />
                        <path d="m17 19-5 3-5-3" />
                        <path d="M2 12h20" />
                        <path d="m5 7-3 5 3 5" />
                        <path d="m19 7 3 5-3 5" />
                    </svg>
                    <h3 class="text-sm font-medium">Aksi Cepat</h3>
                </div>
                <div class="mt-3 grid grid-cols-2 gap-2 sm:grid-cols-4">
                    <a href="" class="flex flex-col items-center rounded-lg border p-3 hover:bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-6 w-6 text-primary">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 12h-4" />
                            <path d="M20 10v4" />
                        </svg>
                        <span class="mt-2 text-xs font-medium">Tambah Peserta</span>
                    </a>
                    <a href="" class="flex flex-col items-center rounded-lg border p-3 hover:bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-6 w-6 text-primary">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                            <line x1="16" x2="16" y1="2" y2="6" />
                            <line x1="8" x2="8" y1="2" y2="6" />
                            <line x1="3" x2="21" y1="10" y2="10" />
                            <path d="M8 14h8" />
                            <path d="M12 18v-8" />
                        </svg>
                        <span class="mt-2 text-xs font-medium">Buat Absensi</span>
                    </a>
                    <a href="" class="flex flex-col items-center rounded-lg border p-3 hover:bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-6 w-6 text-primary">
                            <path d="M15 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3" />
                            <rect width="8" height="6" x="16" y="16" rx="1" />
                            <path d="M17 11h1" />
                            <path d="M20 11h1" />
                            <path d="M23 11h1" />
                            <path d="M8 11h1" />
                            <path d="M11 11h1" />
                            <path d="M14 11h1" />
                        </svg>
                        <span class="mt-2 text-xs font-medium">Scan Absen</span>
                    </a>
                    <a href="" class="flex flex-col items-center rounded-lg border p-3 hover:bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-6 w-6 text-primary">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                            <polyline points="14 2 14 8 20 8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                            <path d="M10 9H8" />
                        </svg>
                        <span class="mt-2 text-xs font-medium">Lihat Data</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Absensi -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium">Absensi Terbaru</h3>
                    <a href="" class="text-sm text-primary hover:underline">
                        Lihat Semua
                    </a>
                </div>
                <div class="mt-4 space-y-4">
                    <template x-for="item in recentAbsensi" :key="item.id">
                        <div class="flex items-center justify-between rounded-lg border p-4">
                            <div class="space-y-1">
                                <h4 class="font-medium" x-text="item.nama"></h4>
                                <p class="text-xs text-muted-foreground" x-text="item.tanggal"></p>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    <p class="text-sm font-medium" x-text="`${item.pesertaHadir}/${item.totalPeserta}`">
                                    </p>
                                    <p class="text-xs text-muted-foreground"
                                        x-text="`${getAttendancePercentage(item)}% Hadir`"></p>
                                </div>
                                <a href="" class="rounded-full bg-primary/10 p-2 text-primary hover:bg-primary/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Peserta Overview -->
        <div class="grid gap-4 md:grid-cols-2">
    <!-- Gender Distribution -->
    <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium">Distribusi Jenis Kelamin</h3>
        </div>
        <div class="mt-4 flex items-center justify-center">
            <div class="relative h-40 w-40">
                <!-- Donut Chart -->
                @php
                    $total = count($pesertas);
                    $malePercentage = $total > 0 ? ($jumlahLakiLaki / $total) * 251.2 : 0;
                    $femalePercentage = $total > 0 ? ($jumlahPerempuan / $total) * 251.2 : 0;
                @endphp
                <svg class="h-full w-full" viewBox="0 0 100 100">
                    <!-- Male segment -->
                    <circle cx="50" cy="50" r="40" fill="transparent" stroke="hsl(210, 100%, 60%)"
                        stroke-width="20" stroke-dasharray="{{ $malePercentage }} 251.2" stroke-dashoffset="0"
                        transform="rotate(-90 50 50)" />
                    <!-- Female segment -->
                    <circle cx="50" cy="50" r="40" fill="transparent" stroke="hsl(340, 100%, 70%)"
                        stroke-width="20" stroke-dasharray="{{ $femalePercentage }} 251.2" stroke-dashoffset="-{{ $malePercentage }}"
                        transform="rotate(-90 50 50)" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <p class="text-sm font-medium">Total</p>
                    <p class="text-2xl font-bold">{{ $total }}</p>
                </div>
            </div>
        </div>
        <div class="mt-4 flex justify-center gap-6">
            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-blue-500"></span>
                <span class="text-sm">Laki-laki: {{ $jumlahLakiLaki }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-pink-500"></span>
                <span class="text-sm">Perempuan: {{ $jumlahPerempuan }}</span>
            </div>
        </div>
    </div>

    <!-- Attendance Overview -->
    <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium">Ringkasan Kehadiran</h3>
        </div>
        <div class="mt-4 space-y-4">
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span>Pengenalan Sistem Informasi</span>
                    <span class="font-medium">71%</span>
                </div>
                <div class="h-2 w-full rounded-full bg-secondary">
                    <div class="h-full rounded-full bg-primary" style="width: 71%"></div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span>Dasar Pemrograman Web</span>
                    <span class="font-medium">77%</span>
                </div>
                <div class="h-2 w-full rounded-full bg-secondary">
                    <div class="h-full rounded-full bg-primary" style="width: 77%"></div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span>Database Management</span>
                    <span class="font-medium">65%</span>
                </div>
                <div class="h-2 w-full rounded-full bg-secondary">
                    <div class="h-full rounded-full bg-primary" style="width: 65%"></div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span>UI/UX Design</span>
                    <span class="font-medium">0%</span>
                </div>
                <div class="h-2 w-full rounded-full bg-secondary">
                    <div class="h-full rounded-full bg-primary" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
