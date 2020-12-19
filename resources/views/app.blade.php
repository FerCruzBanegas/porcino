<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>Granja</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{{ asset('img/login.png') }}}">
    <link href="{{{ asset('css/app.css') }}}" rel="stylesheet">
    <link href="{{{ asset('css/main.css') }}}" rel="stylesheet">
    <link href="{{{ asset('css/ionicons.css') }}}" rel="stylesheet">
  </head>
  <body class="{{ Auth::check() ? 'default-theme' : 'my-login-page' }}">
    <div class="{{ Auth::check() ? 'layout-container' : '' }}">
      @auth
        @include('layouts.navbar')
        @include('layouts.search')
        @include('layouts.sidebar')
      @endauth
      <div class="{{ Auth::check() ? 'main-container' : '' }}" id="app">
        @yield('login')
        <section class="section-container">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-12">
                @yield('content')
              </div>
            </div>
          </div>
        </section>
        @auth
          @include('layouts.footer')
        @endauth 
      </div>
    </div>
    <script src="{{{ asset('js/app.js') }}}"></script>
    <script src="{{{ asset('js/main.js') }}}"></script>
  </body>
</html>
