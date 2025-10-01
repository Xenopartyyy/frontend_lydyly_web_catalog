<!-- Navbar di Atas -->
<div class="top-navbar bg-black text-white py-2" style="font-family: Poppins; font-size: 0.875rem;">
    <div class="max-w-screen-xl mx-auto flex justify-between items-center px-4">
        <!-- Tengah: Ikon Media Sosial -->
        <div class="flex space-x-4">
            <p class="md:block hidden">{{ __('navbar.rmua') }}</p>
            <a href="https://www.instagram.com/agreeofficial.store?igsh=Z2o2Z3EwNmh2ZDhj" target="_blank"
                class="hover:text-red-500 transition duration-300">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/@agree.official?_t=ZS-8tWArBXJ96Y&_r=1" target="_blank"
                class="hover:text-red-500 transition duration-300">
                <i class="fab fa-tiktok"></i>
            </a>
            <a href="mailto:agree.officialstore@gmail.com" target="_blank"
                class="hover:text-red-500 transition duration-300">
                <i class="fas fa-envelope"></i>
            </a>
        </div>

        <!-- Kanan: FAQ, Contact Us, dan Dropdown Bahasa -->
        <div class="flex items-center space-x-6">
            <a href="{{ url('/qna') }}" class="hover:text-red-500 transition duration-300">{{ __('navbar.faq') }}</a>
            <a href="#contactfooter" class="hover:text-red-500 transition duration-300">{{ __('navbar.contact_us')
                }}</a>

            <!-- Dropdown Bahasa -->
            <!-- Language Switcher -->

        </div>
    </div>
</div>