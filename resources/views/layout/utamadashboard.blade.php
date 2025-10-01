<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Lydyly</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('public/public/favicon/favicon.ico') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/ca4cafcf9e.js" crossorigin="anonymous"></script>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href={{ asset('public/css/datatables.min.css') }}>
  <!-- Add this to your layout file -->
  @notifyCss

</head>


<body class="flex">
  <!-- Sidebar -->
  @include('partial.sidebar')

  <!-- Main Content -->
  <div class="flex-grow p-6 bg-pink-100">

    <!-- Dashboard Content -->
    @include('notify::components.notify')
    @notifyJs
    @yield('kontendashboard')
  </div>
  <style>
    * {
      font-family: "Outfit", sans-serif;
      font-optical-sizing: auto;
      font-weight: <weight>;
      font-style: normal;
    }
  </style>

  <script src="{{ asset('public/public/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('public/public/js/datatables.min.js') }}"></script>
  <script>
    let token = "{{ session('access_token') }}";

        // Setup default AJAX config
        $.ajaxSetup({
            headers: {
                "Authorization": "Bearer " + token
            }
        });

        // Global handler kalau token expired
        $(document).ajaxError(function(event, xhr) {
            if (xhr.status === 401) {
                window.location.href = "/login";
            }
        });

        function openModal(deleteUrl, noart) {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.bg-white');
            const deleteMessage = document.getElementById('deleteMessage');

            // Set pesan konfirmasi dengan nomor artikel
            // deleteMessage.textContent = `Apakah Anda yakin ingin menghapus artikel ${noart}?`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modal.classList.remove('opacity-0');
                modalContent.classList.add('scale-100');
                modalContent.classList.remove('scale-95');
            }, 10);
            document.getElementById('deleteForm').setAttribute('action', deleteUrl);
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.bg-white');

            modal.classList.add('opacity-0');
            modal.classList.remove('opacity-100');
            modalContent.classList.add('scale-95');
            modalContent.classList.remove('scale-100');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Tunggu animasi selesai baru sembunyikan
        }
  </script>
  @stack('script')

</body>

</html>