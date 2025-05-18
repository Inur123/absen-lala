@extends('layouts.app')
@section('title', 'Absensi')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Scan Absen</h1>
                <p class="text-muted-foreground">Pilih absensi yang ingin di-scan.</p>
            </div>

        </div>

        <!-- Absensi List -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($materis as $materi)
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden">
                    <div class="p-6 flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <h3 class="font-semibold tracking-tight">
                                {{ $materi->nama }}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-muted-foreground">Kehadiran {{ $materi->nama }}</span>
                                <span class="font-medium">
                                    {{ $jumlahHadirPerMateri[$materi->id] ?? 0 }}/{{ $totalPeserta }}
                                </span>
                            </div>
                            <div class="relative w-full h-2 rounded-full bg-gray-200 overflow-hidden">
                                <div class="absolute top-0 left-0 h-full bg-gray-900 rounded-full"
                                    style="width: {{ $persentasePerMateri[$materi->id] ?? 0 }}%;"></div>
                            </div>
                            <div class="text-xs text-muted-foreground text-right">
                                {{ $persentasePerMateri[$materi->id] ?? 0 }}%
                            </div>
                        </div>

                        <div class="mt-2 flex items-center justify-end gap-2">
                            <a href="{{ route('absensi.scan.page', $materi->id) }}"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-black text-white cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-2 h-4 w-4">
                                    <path d="M15 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3" />
                                    <rect width="8" height="6" x="16" y="16" rx="1" />
                                    <path d="M17 11h1" />
                                    <path d="M20 11h1" />
                                    <path d="M23 11h1" />
                                    <path d="M8 11h1" />
                                    <path d="M11 11h1" />
                                    <path d="M14 11h1" />
                                </svg>
                                Scan Absen
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
