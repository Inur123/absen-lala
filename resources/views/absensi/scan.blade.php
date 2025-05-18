@extends('layouts.app')
@section('title', 'Absensi')
@section('content')

    <div class="flex flex-col gap-4">
        <!-- Notification System -->
        <div x-data="{ showNotification: false, notificationMessage: '', notificationType: 'success', notificationData: null }" x-show="showNotification" x-transition
            @notification.window="
                notificationMessage = $event.detail.message;
                notificationType = $event.detail.type;
                notificationData = $event.detail.data;
                showNotification = true;
                setTimeout(() => showNotification = false, 2000);
             "
            class="fixed inset-0 z-50 flex items-center justify-center">
            <div x-bind:class="{
                'bg-white border border-gray-200 text-gray-900 shadow-sm': notificationType === 'success',
                'bg-red-50 border border-red-300 text-red-900 shadow-sm': notificationType === 'error',
                'bg-blue-50 border border-blue-300 text-blue-900 shadow-sm': notificationType === 'info'
            }"
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 w-[90%] max-w-md p-5 rounded-lg flex flex-col items-center text-center transition-shadow duration-200">
                <div class="mb-4">
                    <svg x-show="notificationType === 'success'" xmlns="http://www.w3.org/2000/svg"
                        class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <svg x-show="notificationType === 'error'" xmlns="http://www.w3.org/2000/svg"
                        class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <svg x-show="notificationType === 'info'" xmlns="http://www.w3.org/2000/svg"
                        class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M12 19a7 7 0 110-14 7 7 0 010 14z" />
                    </svg>
                </div>

                <h3 class="text-lg font-semibold mb-1" x-text="notificationMessage"></h3>

                <div x-show="notificationData" class="text-sm mt-2 text-center w-full space-y-1">
                    <p class="font-medium">Detail Peserta:</p>
                    <p x-text="'Nama: ' + notificationData.nama"></p>
                    <p x-text="'Asal Delegasi: ' + notificationData.asal_delegasi"></p>
                    <p x-text="'Materi: ' + notificationData.materi"></p>
                </div>
            </div>

        </div>

        <!-- Rest of your content remains the same -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">{{ $materi->nama }}</h1>
                <p class="text-gray-500">Scan QR Code peserta untuk melakukan absensi.</p>
            </div>
            <a href="{{ route('absensi.index') }}"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-gray-200 bg-black text-white px-4 py-2 text-sm font-medium shadow-sm transition-colors  focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-400 disabled:pointer-events-none disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <!-- QR Scanner Section -->
            <div class="rounded-lg border bg-white text-gray-900 shadow-sm">
                <div class="p-4 border-b">
                    <h3 class="font-semibold">Scan QR Code</h3>
                </div>
                <div class="p-6 flex flex-col items-center justify-center">
                    <div class="relative w-full aspect-square max-w-xs bg-black rounded-lg overflow-hidden">
                        <!-- Camera Preview -->
                        <div id="qr-reader" class="w-full h-full"></div>

                        <!-- Camera Placeholder (shown when camera not active) -->
                        <div id="camera-placeholder"
                            class="absolute inset-0 flex items-center justify-center bg-black rounded-lg overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-16 w-16 text-white/50">
                                <path d="M15 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3" />
                                <rect width="8" height="6" x="16" y="16" rx="1" />
                                <path d="M17 11h1" />
                                <path d="M20 11h1" />
                                <path d="M23 11h1" />
                                <path d="M8 11h1" />
                                <path d="M11 11h1" />
                                <path d="M14 11h1" />
                            </svg>
                        </div>

                        <!-- Scanning Animation (shown when camera is active) -->
                        <div id="scan-animation" class="relative w-full h-full" style="display: none;">
                            <div class="absolute left-0 w-full h-[2px] bg-green-500 animate-[scan_2s_ease-in-out_infinite]">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <p id="scan-instruction" class="text-sm text-gray-500">Kamera akan aktif secara otomatis</p>
                        <p id="scan-success" class="text-sm font-medium text-green-600" style="display: none;">Arahkan
                            kamera ke QR Code peserta</p>
                    </div>

                    <div class="mt-4 w-full">
                        <button id="restart-scanner"
                            class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-md bg-black px-4 py-2 text-sm font-medium text-white shadow transition-colors  focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-400 disabled:pointer-events-none disabled:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mr-2 h-4 w-4">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>
                            Mulai Ulang Scanner
                        </button>
                    </div>
                </div>
            </div>

            <!-- Attendance List -->
            <div class="rounded-lg border bg-white text-gray-900 shadow-sm">
                <div class="p-4 border-b flex items-center justify-between">
                    <h3 class="font-semibold">Daftar Kehadiran</h3>
                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                        {{ $absensis->count() }}/{{ $pesertas->count() }} Hadir
                    </span>
                </div>
                <div class="p-0">
                    <div class="relative w-full overflow-auto">
                        <table class="w-full caption-bottom text-sm">
                            <thead class="[&_tr]:border-b">
                                <tr class="border-b transition-colors hover:bg-gray-50 data-[state=selected]:bg-gray-100">
                                    <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">No</th>
                                    <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">Nama Lengkap
                                    </th>
                                    <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">Asal Delegasi
                                    </th>
                                    <th class="h-10 px-4 text-left align-middle font-medium text-gray-500">Status</th>
                                </tr>
                            </thead>
                            <tbody class="[&_tr:last-child]:border-0">
                                @foreach ($pesertas as $index => $peserta)
                                    @php
                                        $absen = $absensis->firstWhere('peserta_id', $peserta->id);
                                    @endphp
                                    <tr
                                        class="border-b transition-colors hover:bg-gray-50 data-[state=selected]:bg-gray-100">
                                        <td class="p-4 align-middle">{{ $index + 1 }}</td>
                                        <td class="p-4 align-middle font-medium">{{ $peserta->nama }}</td>
                                        <td class="p-4 align-middle">{{ $peserta->asal_delegasi }}</td>
                                        <td class="p-4 align-middle">
                                            @if ($absen && $absen->status === 'Hadir')
                                                <div
                                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                                    Hadir
                                                </div>
                                            @else
                                                <div
                                                    class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-500">
                                                    Belum Hadir
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load html5-qrcode library -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let html5QrCode;
            let scannerActive = false;
            const restartButton = document.getElementById('restart-scanner');
            const cameraPlaceholder = document.getElementById('camera-placeholder');
            const scanAnimation = document.getElementById('scan-animation');
            const scanInstruction = document.getElementById('scan-instruction');
            const scanSuccess = document.getElementById('scan-success');

            let currentPeserta = null;
            let currentMateriId = {{ $materi->id }};

            function showNotification(message, type = 'success', data = null) {
                window.dispatchEvent(new CustomEvent('notification', {
                    detail: {
                        message: message,
                        type: type,
                        data: data
                    }
                }));
            }

            function updateUIForScanning() {
                cameraPlaceholder.style.display = 'none';
                scanAnimation.style.display = 'block';
                scanInstruction.textContent = 'Arahkan kamera ke QR Code peserta';
                scanSuccess.style.display = 'none';

            }

            function updateUIForIdle() {
                cameraPlaceholder.style.display = 'flex';
                scanAnimation.style.display = 'none';
                scanInstruction.textContent = 'Kamera akan aktif secara otomatis';
                scanSuccess.style.display = 'none';
            }

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`QR Code decoded: ${decodedText}`);

                if (html5QrCode) {
                    html5QrCode.stop().then(() => {
                        scannerActive = false;
                    }).catch(err => {
                        console.error("Error stopping scanner:", err);
                    });
                }

                fetch("{{ route('absensi.scan') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            qrcode: decodedText,
                            materi_id: currentMateriId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Verification response:', data);

                        if (data.success) {
                            showNotification('Absensi berhasil', 'success', {
                                nama: data.peserta.nama,
                                asal_delegasi: data.peserta.asal_delegasi,
                                materi: data.materi.nama
                            });

                            setTimeout(() => {
                                startScanner();
                                window.location.reload();
                            }, 1000);

                        } else {
                            showNotification(data.message || 'Gagal memverifikasi QR Code', 'error');
                            startScanner();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Terjadi kesalahan saat memverifikasi QR Code', 'error');
                        startScanner();
                    });
            }

            function onScanFailure(error) {
                console.warn(`QR error = ${error}`);
            }

            function startScanner() {
                if (scannerActive) return;

                updateUIForScanning();

                html5QrCode = new Html5Qrcode("qr-reader");
                const qrCodeSuccessCallback = onScanSuccess;

                const config = {
                    fps: 10,
                    aspectRatio: 1.0,
                    disableFlip: false
                };

                html5QrCode.start({
                        facingMode: "environment"
                    },
                    config,
                    qrCodeSuccessCallback,
                    onScanFailure
                ).then(() => {
                    scannerActive = true;
                    console.log("Scanner started successfully");
                }).catch(err => {
                    console.error("Error starting scanner:", err);
                    showNotification('Tidak dapat mengakses kamera: ' + err.message, 'error');
                    updateUIForIdle();
                });
            }

            restartButton.addEventListener('click', function() {
                if (html5QrCode && scannerActive) {
                    html5QrCode.stop().then(() => {
                        scannerActive = false;
                        startScanner();
                    }).catch(err => {
                        console.error("Error stopping scanner:", err);
                    });
                } else {
                    startScanner();
                }
            });

            startScanner();
        });
    </script>
@endsection
