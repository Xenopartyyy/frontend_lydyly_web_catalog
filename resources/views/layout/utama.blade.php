<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Agree Commerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ca4cafcf9e.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <!-- Font Awesome Link for Icons -->
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'></script>
    <script>
        var wa_btnSetting = {
            "btnColor": "#16BE45",
            "ctaText": "",
            "cornerRadius": 40,
            "marginBottom": 20,
            "marginLeft": 20,
            "marginRight": 20,
            "btnPosition": "right",
            "whatsAppNumber": "62895359515260",
            "welcomeMessage": "Halo, Saya mau pesan barang Agree!",
            "zIndex": 999999,
            "btnColorScheme": "light"
        };
        window.onload = () => {
            _waEmbed(wa_btnSetting);
        };
    </script>
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Agree" />
    {{--
    <link rel="manifest" href="/site.webmanifest" /> --}}

</head>


<body class="bg-transparent overflow-x-hidden" style="overflow-x: hidden; font-family:Poppins">
    @include('partial.topnavbar')

    @include('partial.navbar')


    @yield('konten')


    @include('partial.footer')


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


</body>

</html>