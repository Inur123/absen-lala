<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Acme Inc</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    email: '',
    password: '',
    loading: false,
    showPassword: false,
    login() {
        this.loading = true;
        // The form will handle the actual submission
        document.getElementById('loginForm').submit();
    },
    togglePassword() {
        this.showPassword = !this.showPassword;
    }
}">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
        <div class="p-8">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Silahkan Login</h1>
                <p class="text-gray-500">Absensi Latin Latpel PC IPNU IPPNU Magetan</p>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}" @submit.prevent="login" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <input x-model="email" type="email" id="email" name="email"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition-all"
                            placeholder="email"required />
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
                            placeholder="password"required />
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

                <button type="submit"
                    class="w-full bg-gray-900 text-white py-3 px-4 rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors font-medium flex items-center justify-center"
                    :disabled="loading">
                    <span x-show="loading" class="inline-flex items-center">
                        <i class="ri-loader-4-line animate-spin mr-2"></i>
                    </span>
                    <span x-text="loading ? 'Logging in...' : 'Login'"></span>
                    <i x-show="!loading" class="ri-arrow-right-line ml-2"></i>
                </button>
            </form>
        </div>
    </div>
</body>

</html>
