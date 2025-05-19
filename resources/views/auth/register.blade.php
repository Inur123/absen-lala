<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Acme Inc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <meta property="og:title" content="lala25.zainur.my.id - Sistem Absensi Latin Latpel PC IPNU IPPNU Magetan" />
    <meta property="og:description" content="Sistem Absensi LATIN-LATPEL untuk PC IPNU IPPNU Magetan" />
    <meta property="og:url" content="https://lala25.zainur.my.id/login" />
    <meta property="og:type" content="website" />
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4" x-data="{
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    loading: false,
    showPassword: false,
    showConfirmPassword: false,
    register() {
        this.loading = true;
        document.getElementById('registerForm').submit();
    },
    togglePassword() {
        this.showPassword = !this.showPassword;
    },
    toggleConfirmPassword() {
        this.showConfirmPassword = !this.showConfirmPassword;
    }
}">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
        <div class="p-8">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Buat Akun Baru</h1>
                <p class="text-gray-500">Sistem Absensi Latin Latpel <br>PC IPNU IPPNU Magetan</p>
            </div>

            <form id="registerForm" method="POST" action="{{ route('register') }}" @submit.prevent="register"
                class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <input x-model="name" type="text" id="name" name="name"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition-all"
                            placeholder="Nama Lengkap" required />
                        <i class="ri-user-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input x-model="email" type="email" id="email" name="email"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition-all"
                            placeholder="email" required />
                        <i class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input x-model="password" :type="showPassword ? 'text' : 'password'" id="password"
                            name="password"
                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition-all"
                            placeholder="password" required />
                        <i class="ri-lock-2-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <button type="button" @click="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                        Password</label>
                    <div class="relative">
                        <input x-model="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'"
                            id="password_confirmation" name="password_confirmation"
                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition-all"
                            placeholder="konfirmasi password" required />
                        <i class="ri-lock-2-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <button type="button" @click="toggleConfirmPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i :class="showConfirmPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gray-900 text-white py-3 px-4 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center"
                    :disabled="loading">
                    <span x-show="loading" class="inline-flex items-center">
                        <i class="ri-loader-4-line animate-spin mr-2"></i>
                    </span>
                    <span x-text="loading ? 'Mendaftarkan...' : 'Daftar'"></span>
                    <i x-show="!loading" class="ri-arrow-right-line ml-2"></i>
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="text-gray-700 font-medium hover:text-gray-900 hover:underline">Masuk disini</a>
            </div>
        </div>
    </div>
</body>

</html>
