@extends('layouts.app')
@section('title', 'Materi')
@section('content')
    <div class="flex flex-col gap-4" x-data="{
        showModal: false,
        showEditModal: false,
        newAbsensi: {
            nama: '',
            deskripsi: ''
        },
        editAbsensi: {
            id: '',
            nama: '',
            deskripsi: ''
        },
        createAbsensi() {
            // Here you would typically send the data to your backend
            console.log('Creating absensi:', this.newAbsensi);

            // Reset form and close modal
            this.newAbsensi = { nama: '', deskripsi: '' };
            this.showModal = false;

            // You might want to add a success message or refresh the data
            // alert('Absensi created successfully!');
        },
        openEditModal(materi) {
            this.editAbsensi = {
                id: materi.id,
                nama: materi.nama,
                deskripsi: materi.deskripsi || ''
            };
            this.showEditModal = true;
        }
    }">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Buat Absensi</h1>
                <p class="text-muted-foreground">Buat dan kelola data absensi baru.</p>
            </div>
            <button @click="showModal = true"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-4 py-2 text-sm font-medium shadow transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-black text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="mr-2 h-4 w-4">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Buat Absensi Baru
            </button>
        </div>

        <!-- Absensi List -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($materis as $materi)
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden">
                    <div class="p-6 flex flex-col space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold tracking-tight">
                                {{ $materi->nama }}
                            </h3>
                        </div>
                        <p class="text-sm text-slate-500">
                            {{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}
                        </p>

                        <div class="mt-2 flex items-center justify-end gap-2">
                            <button @click="openEditModal(@js($materi))"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-black px-3 py-2 text-xs font-medium text-white shadow transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-black cursor-pointer"
                                title="Edit Materi">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-2 h-3 w-3">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Edit
                            </button>

                            <form action="{{ route('materi.destroy', $materi->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-white px-3 py-2 text-xs font-medium text-black shadow transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-black disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-3 w-3">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        <line x1="10" x2="10" y1="11" y2="17" />
                                        <line x1="14" x2="14" y1="11" y2="17" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal Add -->
        <div x-show="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-background/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="w-full max-w-md rounded-lg border bg-card p-6 shadow-lg bg-white"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="transform scale-95 opacity-0"
                x-transition:enter-end="transform scale-100 opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="transform scale-100 opacity-100"
                x-transition:leave-end="transform scale-95 opacity-0" @click.away="showModal = false">
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-2">
                        <div class="rounded-full bg-primary/10 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4 text-primary">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                                <path d="m9 16 2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Buat Absensi Baru</h3>
                    </div>

                    <form method="POST" action="{{ route('materi.store') }}">
                        @csrf
                        <div class="grid gap-4">
                            <div class="grid gap-2">
                                <label for="nama" class="text-sm font-medium">Nama Materi</label>
                                <input type="text" id="nama" name="nama" x-model="newAbsensi.nama"
                                    class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    placeholder="Masukkan nama materi" required />
                            </div>

                            <div class="grid gap-2">
                                <label for="deskripsi" class="text-sm font-medium">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" x-model="newAbsensi.deskripsi"
                                    class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    placeholder="Masukkan deskripsi materi"></textarea>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" @click="showModal = false"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                                Batal
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-black text-white cursor-pointer">
                                Buat Absensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div x-show="showEditModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-background/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="w-full max-w-md rounded-lg border bg-card p-6 shadow-lg bg-white"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="transform scale-95 opacity-0"
                x-transition:enter-end="transform scale-100 opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="transform scale-100 opacity-100"
                x-transition:leave-end="transform scale-95 opacity-0" @click.away="showEditModal = false">
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-2">
                        <div class="rounded-full bg-primary/10 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4 text-primary">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                                <path d="m9 16 2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Edit Absensi</h3>
                    </div>

                    <form method="POST" x-bind:action="'/materi/' + editAbsensi.id" x-data="{ editUrl: '/materi/' + editAbsensi.id }">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4">
                            <div class="grid gap-2">
                                <label for="edit-nama" class="text-sm font-medium">Nama Materi</label>
                                <input type="text" id="edit-nama" name="nama" x-model="editAbsensi.nama"
                                    class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    placeholder="Masukkan nama materi" required />
                            </div>

                            <div class="grid gap-2">
                                <label for="edit-deskripsi" class="text-sm font-medium">Deskripsi</label>
                                <textarea id="edit-deskripsi" name="deskripsi" x-model="editAbsensi.deskripsi"
                                    class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    placeholder="Masukkan deskripsi materi"></textarea>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" @click="showEditModal = false"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 cursor-pointer">
                                Batal
                            </button>
                            <button type="submit"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-black text-white cursor-pointer">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
