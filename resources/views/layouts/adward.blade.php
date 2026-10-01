<!DOCTYPE html>
<html lang="id">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('title', 'TK Harapan Bunda')</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('adward/css/bootstrap.css') }}" />
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- font awesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="{{ asset('adward/css/style.css') }}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('adward/css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
  @yield('top_container')

  @yield('content')

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; 2026 TK Harapan Bunda. All Rights Reserved.
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="{{ asset('adward/js/jquery-3.4.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('adward/js/bootstrap.js') }}"></script>

  @yield('scripts')
</body>

</html>
