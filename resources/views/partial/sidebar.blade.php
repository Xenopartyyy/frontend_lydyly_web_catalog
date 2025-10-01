<!-- Sidebar Layout Partial -->
<div id="app" class="flex min-h-screen h-screen bg-gray-100">
  <!-- Sidebar -->
  <div id="sidebar"
    class="fixed inset-y-0 left-0 w-64 bg-pink-400 text-white transform -translate-x-full transition-transform duration-300 ease-in-out shadow-lg z-50 overflow-y-auto h-screen no-scrollbar">
    <div class="p-4 text-2xl font-bold text-center border-b border-white">Lydyly Dashboard</div>
    <nav class="mt-4 flex-grow space-y-1">

      <div class="relative">
        <a href="{{ url('/dashboard/lydyly2') }}"
          class="flex items-center w-full px-4 py-3 text-white hover:bg-gray-700 hover:text-white rounded transition">
          <i class="fa-regular fa-keyboard"></i>
          <p class="ml-2">Dashboard Utama</p>
        </a>
      </div>

      {{-- <div class="relative">
        <a href="{{ url('/dashboard/brand') }}"
          class="flex items-center w-full px-4 py-3 text-white hover:bg-gray-700 hover:text-white rounded transition">
          <i class="fa-regular fa-copyright"></i>
          <p class="ml-2">Brand</p>
        </a>
      </div>

      <div class="relative">
        <a href="{{ url('/dashboard/kategori') }}"
          class="flex items-center w-full px-4 py-3 text-white hover:bg-gray-700 hover:text-white rounded transition">
          <i class="fa-solid fa-list"></i>
          <p class="ml-2">Kategori</p>
        </a>
      </div> --}}

      <div class="relative">
        <a href="{{ url('/dashboard/produk') }}"
          class="flex items-center w-full px-4 py-3 text-white hover:bg-gray-700 hover:text-white rounded transition">
          <i class="fa-solid fa-box"></i>
          <p class="ml-2">Produk</p>
        </a>
      </div>


    </nav>

    {{-- <div class="text-center rounded-md bg-white py-2 mx-7 my-3">
      <p class="text-sm text-pink-500">Anda login sebagai</p>
      <p class="text-sm text-pink-500 font-semibold">{{ Auth::user()->name }}</p>
    </div> --}}

    <div class="p-4">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full bg-red-500 hover:bg-red-500 text-white font-bold py-2 rounded transition">
          Logout
        </button>
      </form>
    </div>
  </div>

  <!-- Hamburger Button -->
  <div class="fixed top-4 left-4 z-40">
    <button onclick="toggleSidebar()"
      class="text-white bg-pink-400 hover:bg-gray-300 p-3 rounded-full shadow-md focus:outline-none">
      <i class="fa-solid fa-arrow-right-from-bracket fa-xl" style="color: #ffffff;"></i>
    </button>
  </div>

  <!-- Overlay -->
  <div id="overlaysidebar" onclick="toggleSidebar()" class="fixed inset-0 bg-black opacity-60 z-20 hidden"></div>

</div>

<style>
  /* Hide scrollbar while keeping scrolling enabled */
  .no-scrollbar::-webkit-scrollbar {
    width: 0;
    /* For vertical scrollbar */
    height: 0;
    /* For horizontal scrollbar */
  }

  .no-scrollbar {
    scrollbar-width: none;
    /* For Firefox */
    -ms-overflow-style: none;
    /* For IE and Edge */
  }
</style>

<script>
  //SIDEBAR DASHBOARD START
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlaysidebar");
  
  function toggleSidebar() {
  sidebar.classList.toggle("-translate-x-full");
  overlay.classList.toggle("hidden");
  }
  
  function toggleSubMenu(menuId) {
  const menu = document.getElementById(menuId);
  const icon = document.getElementById(`${menuId}-icon`);
  menu.classList.toggle("hidden");
  icon.classList.toggle("rotate-90");
  }
  //SIDEBAR DASHBOARD END
</script>