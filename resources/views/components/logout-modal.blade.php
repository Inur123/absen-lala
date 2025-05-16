<div
  x-show="showLogoutModal"
  class="fixed inset-0 z-50 flex items-center justify-center bg-background/80 backdrop-blur-sm"
  x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition ease-in duration-200"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  @click.self="showLogoutModal = false">
  <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
    @csrf
</form>

  <div
    class="w-full max-w-md rounded-lg border bg-card p-6 shadow-lg"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="transform scale-95 opacity-0"
    x-transition:enter-end="transform scale-100 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="transform scale-100 opacity-100"
    x-transition:leave-end="transform scale-95 opacity-0">
    <div class="flex flex-col space-y-4">
      <div class="flex items-center space-x-2">
        <div class="rounded-full bg-destructive/10 p-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-destructive">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
        </div>
        <h3 class="text-lg font-semibold">Konfirmasi Logout</h3>
      </div>

      <p class="text-sm text-muted-foreground">
        Apakah Anda yakin ingin keluar dari sistem? Semua sesi yang belum disimpan akan hilang.
      </p>

      <div class="mt-4 flex justify-end space-x-2">
        <button
          type="button"
          @click="showLogoutModal = false"
          class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50">
          Batal
        </button>
        <button
    type="button"
    onclick="document.getElementById('logout-form').submit()"
    class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-destructive px-4 py-2 text-sm font-medium text-destructive-foreground shadow transition-colors hover:bg-destructive/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50">
    Logout
</button>
      </div>
    </div>
  </div>
</div>




