<nav class="sticky top-0 bg-black text-white z-50 w-full" style="font-family: Poppins">
    <div class="max-w-screen-xl mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('public/storage/photos/Agree.png') }}" alt="Agree Logo" class="w-15 h-10">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex space-x-6 items-center">
            <a href="{{ url('/') }}" class="text-white hover:text-red-500 transition duration-300">{{ __('navbar.home')
                }}</a>
            <a href="{{ url('/katalog') }}" class="text-white hover:text-red-500 transition duration-300">{{
                __('navbar.shop') }}</a>
            <div class="relative" id="product-parent">
                <!-- Trigger untuk Product -->
                <button id="product-trigger" class=" text-white hover:text-red-500 transition duration-300">
                    {{ __('navbar.product') }}
                    <i class="fa-solid fa-chevron-down"></i> </button>
                <!-- Dropdown Menu -->
                <ul id="product-menu"
                    class="dropdown-menu absolute left-0 hidden bg-black rounded shadow-lg mt-2 w-40 group-hover:block product-children">
                    <li class="relative group">
                        <a href="{{ url('/agree') }}" class="block px-4 py-2 text-white hover:text-red-500">{{
                            __('navbar.mens') }}<i class="fa-solid fa-chevron-right"></i></a>
                        <ul
                            class="dropdown-menu absolute left-full top-0 hidden group-hover:block bg-black rounded shadow-lg w-40">
                            @foreach ($brand_category as $item)
                            @if ($item->brands_id == 1)
                            <li>
                                <a href="{{ route('katalog.index', ['kategori' => $item->kategori->id]) }}"
                                    class="block px-4 py-2 text-white hover:text-red-500">
                                    {{ $item->kategori->nmkategori ?? '-' }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="relative group">
                        <!-- Trigger untuk Kid's -->
                        <a href="{{ url('/agreekids') }}" class="block px-4 py-2 text-white hover:text-red-500">{{
                            __('navbar.kids') }}
                            <i class="fa-solid fa-chevron-right"></i></a>
                        <!-- Submenu -->
                        <ul
                            class="dropdown-menu absolute left-full top-0 hidden group-hover:block bg-black rounded shadow-lg w-40">
                            @foreach ($brand_category as $item)
                            @if ($item->brands_id == 6)
                            <li>
                                <a href="{{ route('katalog.index', ['kategori' => $item->kategori->id]) }}"
                                    class="block px-4 py-2 text-white hover:text-red-500">
                                    {{ $item->kategori->nmkategori ?? '-' }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            <a href="{{ url('/distribution') }}" class="text-white hover:text-red-500 transition duration-300">{{
                __('navbar.distribution') }}</a>
            <div class="relative" id="manufacture-parent">
                <button class=" text-white hover:text-red-500 transition duration-300">{{ __('navbar.manufacture') }} <i
                        class="fa-solid fa-chevron-down"></i></button>
                <!-- Dropdown Menu -->
                <ul id="manufacture-children"
                    class="dropdown-menu absolute left-0 hidden bg-black rounded shadow-lg mt-2 w-40">
                    @foreach ($manufacture2 as $item)
                    <li>
                        <a href="{{ route('manufacture.show', ['manufacture' => $item->tahapfabrikasi]) }}"
                            class="block px-4 py-2 text-white hover:text-red-500">
                            {{ $item->tahapfabrikasi ?? '-' }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="relative" id="about-parent">
                <button class=" text-white hover:text-red-500 transition duration-300">{{ __('navbar.about') }}<i
                        class="fa-solid fa-chevron-down"></i></button>
                <!-- Dropdown Menu -->
                <ul class="dropdown-menu absolute left-0 hidden bg-black rounded shadow-lg mt-2 w-40"
                    id="about-children">
                    <li><a href="{{ url('/tentangkami') }}" class="block px-4 py-2 text-white hover:text-red-500">{{
                            __('navbar.about') }}</a>
                    </li>
                    <li><a href="{{ url('/sejarah') }}" class="block px-4 py-2 text-white hover:text-red-500">{{
                            __('navbar.history') }}</a></li>
                </ul>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="hidden lg:flex items-center">
            <form action="{{ route('katalog.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search Product..."
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                    value="{{ request('search') }}" />
                <button type="submit"
                    class="ml-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
                    {{ __('navbar.search') }}
                </button>
            </form>
        </div>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-8 6h8" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden bg-black text-white">
        <ul class="flex flex-col px-4 py-2 space-y-2">
            <li>
                <form action="{{ route('katalog.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search Product..."
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500 w-full"
                        value="{{ request('search') }}" />
                    <!-- Tombol Submit disembunyikan secara default -->
                    <button type="submit" class="hidden lg:inline-block">Search</button>
                </form>
            </li>
            <li>
                <a href="{{ url('/') }}" class="block px-4 py-2 hover:text-red-500">Home</a>
            </li>
            <li>
                <a href="{{ url('/katalog') }}" class="block px-4 py-2 hover:text-red-500">Shop</a>
            </li>
            <li class="relative">
                <button
                    class="flex justify-between items-center w-full px-4 py-2 hover:text-red-500 focus:outline-none">
                    Product
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
                <ul class="hidden pl-4 bg-gray-800">
                    <li class="relative">
                        <button
                            class="flex justify-between items-center w-full px-4 py-2 hover:text-red-500 focus:outline-none">
                            Men's
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 9l6 6 6-6" />
                            </svg>
                        </button>
                        <ul class="hidden pl-4 bg-gray-700">
                            @foreach ($brand_category as $item)
                            @if ($item->brands_id == 1)
                            <li>
                                <a href="{{ route('katalog.index', ['kategori' => $item->kategori->id]) }}"
                                    class="block px-4 py-2 hover:text-red-500">
                                    {{ $item->kategori->nmkategori ?? '-' }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="relative">
                        <button
                            class="flex justify-between items-center w-full px-4 py-2 hover:text-red-500 focus:outline-none">
                            Kid's
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 9l6 6 6-6" />
                            </svg>
                        </button>
                        <ul class="hidden pl-4 bg-gray-700">
                            @foreach ($brand_category as $item)
                            @if ($item->brands_id == 6)
                            <li>
                                <a href="{{ route('katalog.index', ['kategori' => $item->kategori->id]) }}"
                                    class="block px-4 py-2 hover:text-red-500">
                                    {{ $item->kategori->nmkategori ?? '-' }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/distribution') }}" class="block px-4 py-2 hover:text-red-500">Distribution</a>
            </li>
            <li class="relative">
                <button
                    class="flex justify-between items-center w-full px-4 py-2 hover:text-red-500 focus:outline-none">
                    Manufacture
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
                <ul class="hidden pl-4 bg-gray-700">
                    @foreach ($manufacture2 as $item)
                    <li>
                        <a href="{{ route('manufacture.show', ['manufacture' => $item->tahapfabrikasi]) }}"
                            class="block px-4 py-2 text-white hover:text-red-500">
                            {{ $item->tahapfabrikasi ?? '-' }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="relative">
                <button
                    class="flex justify-between items-center w-full px-4 py-2 hover:text-red-500 focus:outline-none">
                    About us
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6" />
                    </svg>
                </button>
                <ul class="hidden pl-4 bg-gray-700">
                    <li><a href="{{ url('/tentangkami') }}"
                            class="block px-4 py-2 text-white hover:text-red-500">About</a>
                    </li>
                    <li><a href="{{ url('/sejarah') }}"
                            class="block px-4 py-2 text-white hover:text-red-500">History</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    $(document).ready(function(){
        $('#about-parent').on('mouseenter', function() {
            $('#about-children').removeClass('hidden');
        });

        $('#about-parent').on('mouseleave', function() {
            setTimeout(() => {
                if (!$('#about-parent').is(':hover') && !$('#about-children').is(':hover')) {
                    $('#about-children').addClass('hidden');
                }
            }, 200); 
        });

        $('#product-parent').on('mouseenter', function() {
            $('.product-children').removeClass('hidden');
            });
            
            $('#product-parent').on('mouseleave', function() {
            setTimeout(() => {
            if (!$('#product-parent').is(':hover') && !$('.product-children').is(':hover')) {
            $('.product-children').addClass('hidden');
            }
            }, 200);
            });

            $('#manufacture-parent').on('mouseenter', function() {
                    $('#manufacture-children').removeClass('hidden');
                    });
                    
                    $('#manufacture-parent').on('mouseleave', function() {
                    setTimeout(() => {
                    if (!$('#manufacture-parent').is(':hover') && !$('#manufacture-children').is(':hover')) {
                    $('#manufacture-children').addClass('hidden');
                    }
                    }, 200);
                    });
    })
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Dropdown toggle for mobile menu
    const mobileDropdownButtons = document.querySelectorAll('#mobile-menu button');
    mobileDropdownButtons.forEach((button) => {
    button.addEventListener('click', () => {
    const dropdown = button.nextElementSibling;
    if (dropdown) {
    dropdown.classList.toggle('hidden');
    }
    });
    });
    
</script>