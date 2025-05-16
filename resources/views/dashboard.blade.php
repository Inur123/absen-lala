
<div class="card">
    <div class="card-header bg-white border-b border-gray-200">
        <h5 class="mb-0">Dashboard</h5>
    </div>
    <div class="card-body">
        <h4 class="text-xl font-semibold">Welcome, {{ Auth::user()->name }}!</h4>
        <p class="text-gray-600 mt-2">You are logged in!</p>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                <i class="ri-logout-box-r-line mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>

