@extends('layout.utamadashboard')
@section('kontendashboard')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 p-6 text-center">
            <h1 class="text-3xl font-bold text-white">{{ $produk['NamaStock'] }}</h1>
            <p class="text-green-100 mt-2">Detail Produk</p>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col lg:flex-row p-8 gap-8">
            <!-- Image Carousel Section -->
            <div class="w-full lg:w-1/2">
                <div class="bg-gray-50 rounded-xl p-6">
                    @if(!empty($images) && count($images) > 0)
                    <!-- Main Image Display -->
                    <div class="relative group">
                        <div id="carousel" class="relative w-full h-96 overflow-hidden rounded-lg bg-transparent">
                            <div id="carousel-track" class="flex transition-transform duration-500 ease-in-out h-full">
                                @foreach ($images as $index => $image)
                                @php
                                $imageUrl = $image; // sudah full URL dari API
                                @endphp
                                <div class="w-full flex-shrink-0 relative">
                                    <img src="http:\\139.168.116.18:8813\storage\{{ $imageUrl }}"
                                        alt="{{ $produk['NamaStock'] }}"
                                        class="w-full h-96 object-contain cursor-pointer hover:scale-105 transition-transform duration-300"
                                        onclick="openModal('{{ $imageUrl }}')"
                                        onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'; console.log('Image failed to load:', '{{ $imageUrl }}')">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        @if(count($images) > 1)
                        <button id="prevBtn"
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 rounded-full p-3 shadow-lg transition-all duration-200 opacity-0 group-hover:opacity-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="nextBtn"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 rounded-full p-3 shadow-lg transition-all duration-200 opacity-0 group-hover:opacity-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        @endif
                    </div>

                    <!-- Thumbnail Navigation -->
                    @if(count($images) > 1)
                    <div class="flex gap-3 mt-4 justify-center overflow-x-auto pb-2">
                        @foreach ($images as $index => $image)
                        @php
                        $thumbUrl = $image; // langsung pakai dari API
                        @endphp
                        <button
                            class="thumbnail-btn flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all duration-200 
                                        {{ $index === 0 ? 'border-green-500' : 'border-gray-200 hover:border-green-300' }}"
                            data-index="{{ $index }}" onclick="goToSlide({{ $index }})">
                            <img src="http:\\139.168.116.18:8813\storage\{{ $thumbUrl }}"
                                alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'; console.log('Thumbnail failed to load:', '{{ $thumbUrl }}')">
                        </button>
                        @endforeach
                    </div>
                    @endif
                    @else
                    <!-- No Image Placeholder -->
                    <div class="w-full h-96 bg-gray-100 rounded-lg flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-lg font-medium">Tidak ada gambar</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Info Section -->
            <div class="w-full lg:w-1/2">
                <div class="space-y-6">
                    <!-- Product Code -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">No Artikel</label>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $produk['ArtNo'] }}</p>
                    </div>

                    <!-- Pricing Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4 text-center border border-blue-200">
                            <label class="text-sm font-medium text-blue-600 uppercase tracking-wide block">Harga
                                Jual</label>
                            <p class="text-xl font-bold text-blue-800 mt-2">
                                Rp {{ number_format($produk['HargaJual5'], 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-yellow-50 rounded-lg p-4 text-center border border-yellow-200">
                            <label class="text-sm font-medium text-yellow-600 uppercase tracking-wide block">Harga
                                Yuan</label>
                            <p class="text-xl font-bold text-yellow-800 mt-2">
                                ¥ {{ number_format((float) $produk['YUAN'], 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4 text-center border border-red-200">
                            <label class="text-sm font-medium text-red-600 uppercase tracking-wide block">Harga
                                Beli</label>
                            <p class="text-xl font-bold text-red-800 mt-2">
                                Rp {{ number_format($produk['HargaBeli'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Stock Information -->
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <label class="text-sm font-medium text-green-600 uppercase tracking-wide block mb-3">Stok
                            Tersedia</label>
                        <div class="flex items-center justify-between bg-white rounded-lg p-4 border border-green-300">
                            <span class="text-2xl font-bold text-green-800">{{ number_format($produk['StockAkhir'], 0,
                                ',', '.') }}</span>
                            <div class="text-right">
                                <p class="text-sm text-green-600">Unit</p>
                                <p class="text-xs text-gray-500">Update terakhir: {{ now()->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="grid grid-cols-2 gap-4">
                        @if($produk['Jenis'])
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide block">Jenis</label>
                            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $produk['Jenis'] }}</p>
                        </div>
                        @endif
                        @if($produk['Merek'])
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="text-sm font-medium text-gray-500 uppercase tracking-wide block">Merek</label>
                            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $produk['Merek'] }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4">
                        <a href="{{ url('dashboard/produk') }}"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-lg transition duration-200 text-center">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <a href="{{ url('dashboard/produk/'.$produk['id'].'/edit') }}"
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-6 rounded-lg transition duration-200 text-center">
                            <i class="fas fa-edit mr-2"></i>Edit Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div id="imageModal"
    class="fixed inset-0 bg-black bg-opacity-80 items-center justify-center hidden z-50 transition-opacity duration-300">
    <div class="relative max-w-4xl max-h-full p-4">
        <!-- Close Button -->
        <button onclick="closeModal()"
            class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors duration-200 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Image -->
        <img id="modalImage" src="" alt=""
            class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl transition-transform duration-300">
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const track = document.getElementById("carousel-track");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const thumbnailBtns = document.querySelectorAll(".thumbnail-btn");
    
    @php
    $imageCount = count($images ?? []);
    @endphp
    
    const imageCount = {{ $imageCount }};
    let currentIndex = 0;

    function updateSliderPosition() {
        if (track) {
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
        
        // Update thumbnail active state
        thumbnailBtns.forEach((btn, index) => {
            if (index === currentIndex) {
                btn.classList.remove('border-gray-200', 'hover:border-green-300');
                btn.classList.add('border-green-500');
            } else {
                btn.classList.remove('border-green-500');
                btn.classList.add('border-gray-200', 'hover:border-green-300');
            }
        });
    }

    // Previous button
    if (prevBtn) {
        prevBtn.addEventListener("click", function(e) {
            e.stopPropagation();
            currentIndex = (currentIndex - 1 + imageCount) % imageCount;
            updateSliderPosition();
        });
    }

    // Next button
    if (nextBtn) {
        nextBtn.addEventListener("click", function(e) {
            e.stopPropagation();
            currentIndex = (currentIndex + 1) % imageCount;
            updateSliderPosition();
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'Escape') {
                closeModal();
            }
        } else {
            if (e.key === 'ArrowLeft' && imageCount > 1) {
                currentIndex = (currentIndex - 1 + imageCount) % imageCount;
                updateSliderPosition();
            } else if (e.key === 'ArrowRight' && imageCount > 1) {
                currentIndex = (currentIndex + 1) % imageCount;
                updateSliderPosition();
            }
        }
    });

    // Modal click outside to close
    if (modal) {
        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    // Auto-slide (optional)
    let autoSlideInterval;
    
    function startAutoSlide() {
        if (imageCount > 1) {
            autoSlideInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % imageCount;
                updateSliderPosition();
            }, 5000);
        }
    }
    
    function stopAutoSlide() {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
        }
    }
    
    // Start auto-slide
    startAutoSlide();
    
    // Pause auto-slide on hover
    const carousel = document.getElementById('carousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', stopAutoSlide);
        carousel.addEventListener('mouseleave', startAutoSlide);
    }
});

// Global functions for modal and thumbnail navigation
function openModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    
    if (modal && modalImage) {
        modalImage.src = src;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Animate modal appearance
        setTimeout(() => {
            modal.style.opacity = '1';
            modalImage.style.transform = 'scale(1)';
        }, 10);
    }
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    
    if (modal) {
        modal.style.opacity = '0';
        if (modalImage) {
            modalImage.style.transform = 'scale(0.9)';
        }
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }
}

function goToSlide(index) {
    const track = document.getElementById("carousel-track");
    const thumbnailBtns = document.querySelectorAll(".thumbnail-btn");
    
    if (track) {
        currentIndex = index;
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        // Update thumbnail active state
        thumbnailBtns.forEach((btn, btnIndex) => {
            if (btnIndex === currentIndex) {
                btn.classList.remove('border-gray-200', 'hover:border-green-300');
                btn.classList.add('border-green-500');
            } else {
                btn.classList.remove('border-green-500');
                btn.classList.add('border-gray-200', 'hover:border-green-300');
            }
        });
    }
}
</script>

@endsection