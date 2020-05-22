<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Dashboard Laravel') }}</title>

  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vali-admin@3.0.0/docs/css/main.min.css">
  <style>
    a:hover, btn-link {
      text-decoration: none !important;
    }
  </style>

  @stack('styles')
</head>
<body class="app sidebar-mini">
  <main>
    @yield('content')
  </main>

  <script src="https://kit.fontawesome.com/5ed1634b0f.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
          integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
          integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/vali-admin@3.0.0/docs/js/main.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vali-admin@3.0.0/docs/js/plugins/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vali-admin@3.0.0/docs/js/plugins/pace.min.js"></script>
  <script>
    $('.login-content [data-toggle="flip"]').click(function () {
      $('.login-box').toggleClass('flipped');
      return false;
    });
  </script>

  @stack('scripts')
</body>
</html>
