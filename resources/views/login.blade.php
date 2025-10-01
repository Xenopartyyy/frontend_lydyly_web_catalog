<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Lidily</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Animated Background Gradient */
        .animated-bg {
            background: linear-gradient(-45deg, #fdf2f8, #fce7f3, #fbcfe8, #f9a8d4);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating Particles */
        .particle {
            position: absolute;
            background: rgba(236, 72, 153, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 20px;
            height: 20px;
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 30px;
            height: 30px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 25px;
            height: 25px;
            top: 80%;
            left: 30%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 15px;
            height: 15px;
            top: 30%;
            left: 70%;
            animation-delay: 1s;
        }

        .particle:nth-child(5) {
            width: 35px;
            height: 35px;
            top: 70%;
            left: 10%;
            animation-delay: 3s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(120deg);
            }

            66% {
                transform: translateY(20px) rotate(240deg);
            }
        }

        /* Glassmorphism Effect */
        .glass-morphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Logo Glow Animation */
        .logo-glow {
            animation: logoGlow 3s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            from {
                filter: drop-shadow(0 0 5px rgba(236, 72, 153, 0.3));
                transform: scale(1);
            }

            to {
                filter: drop-shadow(0 0 20px rgba(236, 72, 153, 0.6));
                transform: scale(1.02);
            }
        }

        /* Input Focus Animations */
        .input-focus {
            transition: all 0.3s ease;
            position: relative;
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(236, 72, 153, 0.15);
        }

        /* Button Hover Animation */
        .btn-hover {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-hover:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.6s ease;
            transform: translate(-50%, -50%);
        }

        .btn-hover:hover:before {
            width: 300px;
            height: 300px;
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(236, 72, 153, 0.4);
        }

        /* Card Entrance Animation */
        .card-entrance {
            animation: cardSlideUp 0.8s ease-out;
        }

        @keyframes cardSlideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Pulse Animation for Errors */
        .error-pulse {
            animation: errorPulse 0.5s ease-in-out;
        }

        @keyframes errorPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Loading Dots Animation */
        .loading-dots span {
            animation: loadingDots 1.4s infinite ease-in-out;
        }

        .loading-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes loadingDots {

            0%,
            80%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Mobile Optimizations */
        @media (max-width: 640px) {
            .particle {
                display: none;
            }
        }
    </style>
</head>

<body class="animated-bg min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Floating Particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div> <!-- Login Card -->
    <div class="glass-morphism p-8 sm:p-10 rounded-3xl shadow-2xl w-full max-w-md card-entrance relative">
        <!-- Decorative Elements -->
        <div
            class="absolute -top-4 -right-4 w-16 h-16 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full opacity-20">
        </div>
        <div
            class="absolute -bottom-4 -left-4 w-12 h-12 bg-gradient-to-br from-pink-300 to-pink-500 rounded-full opacity-20">
        </div> <!-- Logo Section -->
        <div class="flex justify-center mb-8">
            
            <div class="relative"> <img src="{{ asset('public/storage/photos/lyd.png') }}" alt="Lidily Logo"
                    class="w-32 logo-glow"> <!-- Logo Background Glow -->
                <div
                    class="absolute inset-0 bg-gradient-to-r from-pink-200 to-pink-300 rounded-full blur-xl opacity-30 -z-10">
                </div>
            </div>
        </div> <!-- Welcome Text -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome!</h1>
        </div> <!-- Login Form -->
        <form method="POST" action="{{ url('/login/akun/lydyly2') }}" id="loginForm"> @csrf
            <!-- Username Field -->
            <div class="mb-6"> <label for="name" class="block text-sm font-semibold text-pink-700 mb-2"> Username
                </label> <input type="text" id="name" name="name" required
                    class="input-focus w-full px-4 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-500 focus:ring-0 outline-none transition text-sm bg-white/70"
                    placeholder="Masukkan username Anda"> </div> <!-- Password Field -->
            <div class="mb-6"> <label for="password" class="block text-sm font-semibold text-pink-700 mb-2"> Password
                </label> <input type="password" id="password" name="password" required
                    class="input-focus w-full px-4 py-3 rounded-xl border-2 border-pink-200 focus:border-pink-500 focus:ring-0 outline-none transition text-sm bg-white/70"
                    placeholder="Masukkan password Anda"> </div> <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-6 error-pulse">
                <div
                    class="text-sm font-medium text-pink-700 bg-gradient-to-r from-pink-50 to-rose-50 px-4 py-3 rounded-xl border-l-4 border-pink-400 shadow-sm">
                    <div class="flex items-center"> <span class="mr-2">⚠️</span> {{ $errors->first() }} </div>
                </div>
            </div>
            @endif
            <!-- Login Button --> <button type="submit" id="loginBtn"
                class="btn-hover w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white py-3.5 rounded-xl font-semibold transition duration-300 text-sm relative z-10 shadow-lg">
                <span id="btnText">Masuk Sekarang</span> <span id="btnLoading" class="loading-dots hidden"> Memproses
                    <span class="inline-block w-1 h-1 bg-current rounded-full mx-px"></span> <span
                        class="inline-block w-1 h-1 bg-current rounded-full mx-px"></span> <span
                        class="inline-block w-1 h-1 bg-current rounded-full mx-px"></span> </span> </button>
        </form> <!-- Footer Text -->
        <div class="text-center mt-6">
            <p class="text-xs text-gray-500"> 💎 Powered by SAG Program Team </p>
        </div>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');
            btn.disabled = true;
            btn.classList.add('opacity-80');
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        });
        document.addEventListener('mousemove', function(e) {
            const particles = document.querySelectorAll('.particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            particles.forEach((particle, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;
                particle.style.transform += translate($ {
                        x
                    }
                    px, $ {
                        y
                    }
                    px);
            });
        }); 
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value) {
                    this.classList.add('border-green-300');
                    this.classList.remove('border-pink-200');
                } else {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-pink-200');
                }
            });
        });
    </script>
</body>

</html>