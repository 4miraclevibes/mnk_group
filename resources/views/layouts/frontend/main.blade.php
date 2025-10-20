<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://fip.unp.ac.id/img/logofipicon.png" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Bimbel Jagratara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .navbar{
        background-color: #075308 !important;
      }
      .description-container .description {
          width: 100%;
          word-wrap: break-word;
          overflow-wrap: break-word;
      }

      .description-container img {
        max-width: 100%;
      }

      .description-container figcaption{
        text-align: center;
      }

      .description-container figure .media{
        border: 1px solid #000;
        width: 100px;
      }
      body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    html {
        overflow-x: hidden;
    }
    </style>
    @yield('styles')
  </head>
  <body style="font-family: 'Poppins', sans-serif;">
    @include('layouts.frontend.navbar')
    @yield('content')
    @include('layouts.frontend.footer')

    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'id',
          includedLanguages: 'en,id', // Bahasa Inggris, Indonesia, dan Spanyol
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google-translate-element');
      }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var navbarToggler = document.querySelector('.navbar-toggler');
        var navbarCollapse = document.querySelector('.navbar-collapse');
        var bsCollapse = new bootstrap.Collapse(navbarCollapse, {toggle: false});

        // Menutup navbar saat item menu non-dropdown diklik
        var navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle), .navbar-nav .dropdown-item');
        navLinks.forEach(function(navLink) {
            navLink.addEventListener('click', function() {
                if (window.innerWidth < 992) { // Hanya jalankan pada tampilan mobile
                    bsCollapse.hide();
                }
            });
        });

        // Mencegah penutupan navbar saat dropdown toggle diklik
        var dropdownToggles = document.querySelectorAll('.navbar-nav .dropdown-toggle');
        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                if (window.innerWidth < 992) {
                    event.stopPropagation(); // Mencegah event bubbling
                }
            });
        });

        // Menutup navbar saat mengklik di luar navbar
        document.addEventListener('click', function(event) {
            var isClickInside = navbarCollapse.contains(event.target) || navbarToggler.contains(event.target);
            if (!isClickInside && navbarCollapse.classList.contains('show') && window.innerWidth < 992) {
                bsCollapse.hide();
            }
        });

        // Toggle navbar saat tombol toggler diklik
        navbarToggler.addEventListener('click', function() {
            bsCollapse.toggle();
        });
    });
    </script>
    @yield('scripts')
  </body>
</html>
