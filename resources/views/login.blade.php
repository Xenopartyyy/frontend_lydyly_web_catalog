<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Lidily Catalog System</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/favicon/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #ffc9f3;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .shell {
            display: flex;
            width: 100%;
            max-width: 860px;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            min-height: 520px;
        }

        .info-panel {
            width: 42%;
            background: #ffffff;
            padding: 36px 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sys-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(212, 83, 126, 0.18);
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #F4C0D1;
            width: fit-content;
        }

        .sys-badge-dot {
            width: 6px;
            height: 6px;
            background: #D4537E;
            border-radius: 50%;
        }

        .info-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 28px 0;
        }

        .info-main h2 {
            font-size: 1.35rem;
            font-weight: 600;
            color: #fff;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .info-main p {
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.45);
            line-height: 1.75;
        }

        .pcard-icon svg {
            width: 15px;
            height: 15px;
        }

        .pcard-icon.pink {
            background: rgba(212, 83, 126, 0.2);
            color: #F4C0D1;
        }

        .pcard-icon.teal {
            background: rgba(29, 158, 117, 0.2);
            color: #9FE1CB;
        }

        .pcard-icon.amber {
            background: rgba(186, 117, 23, 0.2);
            color: #FAC775;
        }

        .info-footer {
            font-size: 10.5px;
            color: rgba(255, 255, 255, 0.25);
            line-height: 1.6;
        }

        .login-panel {
            width: 58%;
            padding: 40px 44px;
            background: #fa3fa3;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .logo-row img {
            height: 40px;
            object-fit: contain;
        }

        .logo-divider {
            width: 1px;
            height: 28px;
            background: #E6E3E8;
        }

        .logo-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: #A08898;
        }

        .login-title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #1C0F16;
            margin-bottom: 4px;
        }

        .login-sub {
            font-size: 12.5px;
            color: #9E8A95;
            margin-bottom: 28px;
        }

        .access-info {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            background: #fdff9a;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 22px;
        }

        .access-info svg {
            width: 15px;
            height: 15px;
            color: #D4537E;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .access-info p {
            font-size: 11.5px;
            color: #8B1A4A;
            line-height: 1.5;
        }

        .access-info strong {
            font-weight: 600;
        }

        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: #5C3D4E;
            margin-bottom: 6px;
            letter-spacing: 0.02em;
        }

        .input-row {
            position: relative;
        }

        .input-row svg {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            color: #C4A5B2;
            pointer-events: none;
        }

        .input-row input {
            width: 100%;
            padding: 11px 12px 11px 36px;
            border: 1.5px solid #E6D8DF;
            border-radius: 8px;
            background: #FDFBFC;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            color: #1C0F16;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        }

        .input-row input::placeholder {
            color: #C0A8B5;
        }

        .input-row input:focus {
            border-color: #D4537E;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 83, 126, 0.1);
        }

        .input-row input.valid {
            border-color: #5DCAA5;
            background: #fff;
        }

        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            background: #FEF2F5;
            border: 1px solid #F4C0D1;
            border-left: 3px solid #D4537E;
            border-radius: 0 8px 8px 0;
            padding: 11px 13px;
            margin-bottom: 16px;
        }

        .alert-error svg {
            width: 14px;
            height: 14px;
            color: #D4537E;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-error p {
            font-size: 12px;
            color: #8B1A4A;
            line-height: 1.5;
        }

        .btn-submit {
            width: 100%;
            padding: 12px 16px;
            background: #ffffff;
            color: #fc54b0;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.18s, transform 0.12s;
            margin-top: 4px;
        }

        .btn-submit:hover {
            background: #ff9dc1;
        }

        .btn-submit:hover #btnText {
            color: white;
        }

        .btn-submit:hover svg {
            color: white;
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        .btn-submit:disabled {
            background: #E8A0B8;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit svg {
            width: 14px;
            height: 14px;
            transition: transform 0.18s;
        }

        .btn-submit:hover svg {
            transform: translateX(2px);
        }

        .dots {
            display: none;
            align-items: center;
            gap: 4px;
        }

        .dots span {
            width: 5px;
            height: 5px;
            background: #fff;
            border-radius: 50%;
            animation: db 1.1s infinite ease-in-out;
        }

        .dots span:nth-child(2) {
            animation-delay: 0.15s;
        }

        .dots span:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes db {

            0%,
            80%,
            100% {
                transform: scale(0.6);
                opacity: 0.4;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .panel-footer {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #F0EAF0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-footer p {
            font-size: 11px;
            color: #C0A8B5;
        }

        .version-badge {
            font-size: 10px;
            font-weight: 600;
            background: #F5EEF2;
            color: #9E6880;
            padding: 3px 8px;
            border-radius: 4px;
            letter-spacing: 0.04em;
        }

        @media (max-width: 680px) {
            .shell {
                flex-direction: column;
            }

            .info-panel {
                width: 100%;
                padding: 24px 22px;
            }

            .login-panel {
                width: 100%;
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="shell">
        <!-- INFO PANEL -->
        <div class="info-panel">

            <div class="info-main">
                <img src=" {{ asset('public/storage/photos/ldlynobgnew.png') }}"
                    style="width:300px;margin-bottom:24px;opacity:0.95;">
            </div>
        </div>

        <!-- LOGIN PANEL -->
        <div class="login-panel">
            <div class="logo-row">
                <div class="logo-divider"></div>
                <span class="logo-label" style="color: white">Catalog System</span>
            </div>

            <h1 class="login-title" style="color: white">Masuk ke Sistem</h1>
            <p class="login-sub" style="color: white">Gunakan username dan password yang diberikan oleh admin.</p>

            <div class="access-info">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                <p><strong>Akses Internal</strong> — Portal ini hanya untuk staf gudang yang terdaftar.</p>
            </div>

            <form method="POST" action="{{ url('/login/akun/lydyly2') }}" id="loginForm">
                @csrf
                <div class="field">
                    <label for="name">Username</label>
                    <div class="input-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <input type="text" id="name" name="name" required autocomplete="username"
                            placeholder="Masukkan username Anda">
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••">
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <p>{{ $errors->first() }}</p>
                </div>
                @endif

                <button type="submit" class="btn-submit" id="loginBtn">
                    <span id="btnText" style="display:flex;align-items:center;gap:8px;">
                        Masuk
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </span>
                    <span class="dots" id="btnLoading"><span></span><span></span><span></span></span>
                </button>
            </form>

            <div class="panel-footer">
                <p style="color: white">SAG Program Team &copy; {{ date('Y') }}</p>
                <span class="version-badge">v1.0 Internal</span>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('loginBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');
        btn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'flex';
    });
    document.querySelectorAll('.input-row input').forEach(input => {
        input.addEventListener('blur', function () {
            this.value.trim() ? this.classList.add('valid') : this.classList.remove('valid');
        });
        input.addEventListener('input', function () {
            if (!this.value.trim()) this.classList.remove('valid');
        });
    });
    </script>
</body>

</html>