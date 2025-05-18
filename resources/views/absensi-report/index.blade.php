@extends('layouts.app')
@section('title', 'Absensi Report')
@section('content')

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Absensi Report</h1>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($materis as $materi)
                <div class="rounded-lg border bg-white text-gray-900 shadow-sm">
                    <div class="p-4 border-b flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $materi->nama }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $materi->deskripsi }}</p>
                        </div>
                        <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                            {{ $materi->total_hadir }}/{{ $allPesertas->count() }} Hadir
                        </span>
                    </div>
                    <div class="p-0">
                        <div class="relative w-full overflow-auto">
                            <table class="w-full caption-bottom text-sm">
                                <thead class="[&_tr]:border-b">
                                    <tr
                                        class="border-b transition-colors hover:bg-gray-50 data-[state=selected]:bg-gray-100">
                                        <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">No</th>
                                        <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">Nama Lengkap
                                        </th>
                                        <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">Asal Delegasi
                                        </th>
                                        <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="[&_tr:last-child]:border-0">
                                    @foreach ($allPesertas as $index => $peserta)
                                        @php
                                            $absensi = $materi->absensis->firstWhere('peserta_id', $peserta->id);
                                            $status = $absensi ? $absensi->status : 'Belum Hadir';
                                        @endphp
                                        <tr
                                            class="border-b transition-colors hover:bg-gray-50 data-[state=selected]:bg-gray-100">
                                            <td class="p-4 align-middle">{{ $index + 1 }}</td>
                                            <td class="p-4 align-middle font-medium">{{ $peserta->nama }}</td>
                                            <td class="p-4 align-middle">{{ $peserta->asal_delegasi }}</td>
                                            <td class="p-4 align-middle">
                                                <div
                                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                        {{ $status == 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-500' }}">
                                                    {{ $status }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="p-4 border-t">
                        <div class="flex justify-start">
                            <a href="{{ route('absensi-report.export', $materi->id) }}"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-input bg-background px-3 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-black text-white cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-2 h-4 w-4">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" x2="12" y1="15" y2="3" />
                                </svg>
                                Export Data
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
