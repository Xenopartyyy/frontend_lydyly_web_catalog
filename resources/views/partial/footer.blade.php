<footer id="contactfooter" class="bg-black text-white py-10">
  <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">

    <!-- Logo dan Deskripsi -->
    <div class="space-y-3 text-center">
      <div class="flex items-center justify-center space-x-3">
        <span class="text-xl font-bold ">{{ $perusahaan[0]->nmperusahaan }}</span>
      </div>
      <div class="flex items-center justify-center">
        <span>{{ $perusahaan[0]->alamat }}</span>
      </div>
    </div>

    <!-- Informasi Kontak -->
    <div class="space-y-3 text-center">
      <h3 class="text-xl font-semibold text-green-400">{{ __('navbar.contact_us') }}</h3>
      <div class="space-y-2 ">
        <div class="flex items-center justify-center">
          <i class="fas fa-envelope  mr-2"></i>
          <span>{{ $perusahaan[0]->email }}</span>
        </div>
        <div class="flex items-center justify-center">
          <i class="fas fa-phone-alt  mr-2"></i>
          <span>{{ $perusahaan[0]->telp }}</span>
        </div>
      </div>
    </div>

    <!-- Temukan Kami -->
    {{-- <div class="space-y-4 text-center">
      <h3 class="text-xl font-semibold ">Temukan Kami</h3>
      <div class="space-y-3">
        <div>
          @foreach ($brand as $item)
          @if (!empty($item->linktree))
          <div class="flex justify-center space-x-3">
            <a href="{{ url($item->linktree) }}" target="_blank" class="flex items-center er: transition">
              <i class="fa-solid fa-link"></i> {{ $item->namabrand }}
            </a>
          </div>
          @endif
          @endforeach
        </div>
        <!-- Tambahkan merek lain seperti Agree, Kopral, dsb -->
      </div>
    </div> --}}

    <!-- Navigasi -->
    <div class="space-y-3 text-center">
      <h3 class="text-xl font-semibold text-green-400">Navigasi</h3>
      <nav class="space-y-2">
        <a href="{{url('/')}}" class="block hover: transition">{{ __('navbar.home') }}</a>
        <a href="{{url('/tentangkami')}}" class="block hover: transition">{{ __('navbar.contact_us') }}</a>
        <a href="{{ url('/katalog')}}" class="block hover: transition">Katalog</a>
      </nav>
    </div>

  </div>
  <div class="mt-10 border-t border-gray-700 pt-6 text-center">
    <p class="text-sm">© {{ date('Y') }} {{ $perusahaan[0]->nmperusahaan }}. All rights reserved.</p>
  </div>
</footer>