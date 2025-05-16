@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Peserta</h1>
                <p class="text-muted-foreground">Kelola data peserta kegiatan.</p>
            </div>
            <button @click="showAddModal = true"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-black px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="mr-2 h-4 w-4">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M22 12h-4" />
                    <path d="M20 10v4" />
                </svg>
                Tambah Peserta
            </button>
        </div>

        <!-- Peserta Table -->
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead class="[&_tr]:border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">No</th>
                            <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">QR Code</th>
                            <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Nama Lengkap</th>
                            <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Asal Delegasi
                            </th>
                            <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Jenis Kelamin
                            </th>
                            <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        @foreach ($pesertas as $index => $peserta)
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <td class="p-4 align-middle">{{ $index + 1 }}</td>
                                <td class="p-4 align-middle">
                                    <img src="{{ asset('storage/' . $peserta->qrcode) }}" alt="QR Code"
                                        class="w-24 h-24 object-contain">
                                </td>


                                <td class="p-4 align-middle font-medium">{{ ucwords($peserta->nama) }}</td>
                                <td class="p-4 align-middle">{{ ucwords($peserta->asal_delegasi) }}</td>
                                <td class="p-4 align-middle">{{ ucwords($peserta->jenis_kelamin) }}</td>
                                <td class="p-4 align-middle">
                                    <div class="flex items-center gap-2">
                                        <!-- Edit Button -->
                                        <button @click="showEditModal = true; editData = {{ json_encode($peserta) }}"
                                            class="rounded-md p-1 text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/30 cursor-pointer">
                                          <i class="ri-edit-line text-2xl"></i>

                                        </button>
                                        <!-- Download Button -->
                                        <a href="{{ asset('storage/' . $peserta->qrcode) }}"
                                            download="{{ 'qrcode_' . Str::slug($peserta->nama) . '.png' }}"
                                            class="rounded-md p-1 text-green-600 hover:bg-green-50 dark:text-green-400 dark:hover:bg-green-900/30"
                                            title="Unduh QR Code">
                                            <i class="ri-download-line text-2xl"></i>
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-md p-1 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30 cursor-pointer">
                                               <i class="ri-delete-bin-5-line text-2xl"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div x-show="showAddModal" class="fixed inset-0 z-50 flex items-center justify-center bg-background/80 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="w-full max-w-md rounded-lg border bg-card p-6 shadow-lg"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform scale-95 opacity-0"
            x-transition:enter-end="transform scale-100 opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform scale-100 opacity-100"
            x-transition:leave-end="transform scale-95 opacity-0">
            <div class="flex flex-col space-y-4">
                <div class="flex items-center space-x-2">
                    <div class="rounded-full bg-primary/10 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4 text-primary">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Tambah Peserta Baru</h3>
                </div>
                <form action="{{ route('peserta.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <label for="nama" class="text-sm font-medium">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div class="grid gap-2">
                            <label for="delegasi" class="text-sm font-medium">Asal Delegasi</label>
                            <input type="text" id="delegasi" name="asal_delegasi"
                                class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                placeholder="Masukkan asal delegasi" required />
                        </div>
                        <div class="grid gap-2">
                            <label for="jenisKelamin" class="text-sm font-medium">Jenis Kelamin</label>
                            <select id="jenisKelamin" name="jenis_kelamin"
                                class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="showAddModal = false"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-black px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                            Tambah Peserta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-background/80 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="w-full max-w-md rounded-lg border bg-card p-6 shadow-lg"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform scale-95 opacity-0"
            x-transition:enter-end="transform scale-100 opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="transform scale-100 opacity-100"
            x-transition:leave-end="transform scale-95 opacity-0">
            <div class="flex flex-col space-y-4">
                <div class="flex items-center space-x-2">
                    <div class="rounded-full bg-primary/10 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4 text-primary">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Edit Peserta</h3>
                </div>
                <form x-bind:action="'/peserta/' + editData.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <label for="edit-nama" class="text-sm font-medium">Nama Lengkap</label>
                            <input type="text" id="edit-nama" name="nama" x-model="editData.nama"
                                class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div class="grid gap-2">
                            <label for="edit-delegasi" class="text-sm font-medium">Asal Delegasi</label>
                            <input type="text" id="edit-delegasi" name="asal_delegasi"
                                x-model="editData.asal_delegasi"
                                class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                placeholder="Masukkan asal delegasi" required />
                        </div>
                        <div class="grid gap-2">
                            <label for="edit-jenisKelamin" class="text-sm font-medium">Jenis Kelamin</label>
                            <select id="edit-jenisKelamin" name="jenis_kelamin" x-model="editData.jenis_kelamin"
                                class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                required>
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" @click="showEditModal = false"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                            Batal
                        </button>
                        <button type="submit"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-black px-4 py-2 text-sm font-medium text-white shadow transition-colors hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
