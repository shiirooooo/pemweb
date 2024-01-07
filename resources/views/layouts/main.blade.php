<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">


    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>

<body class="h-100">

    <div class="site-wrap h-100">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-6 col-md-3 order-2 order-md-1 site-search-icon text-left">
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-6 order-1 order-md-2 text-center">
                            <div class="site-logo">
                                <a href="{{ route('home') }}" class="js-logo-clone">{{ config('app.name') }}</a>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 order-3 order-md-3 text-right">
                            <div class="site-top-icons">
                                <ul>
                                    @user
                                    <li>
                                        <a href="{{ route('cart') }}" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count">{{ $cartCount }}</span>
                                        </a>
                                    </li>
                                    @enduser
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                            class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <nav class="site-navigation text-right text-md-center" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        <li class="@if(\Request::route()->getName() == 'home') active @endif">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="@if(request()->is('products*')) active @endif">
                            <a href="{{ route('products.index') }}">Menu</a>
                        </li>
                        @admin
                        <li class="@if(request()->is('orders*')) active @endif">
                            <a href="{{ route('orders') }}">Pesanan Pelanggan</a>
                        </li>
                        @endadmin
                        @user
                        <li class="@if(request()->is('my-orders') || request()->is('orders*')) active @endif">
                            <a href="{{ route('my-orders') }}">Pesanan Saya</a>
                        </li>
                        @enduser
                        @auth
                        <li class="@if(request()->is('logout')) active @endif">
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                        @endauth
                        @guest
                        <li class="@if(request()->is('login')) active @endif">
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>

        @yield('container')

        <footer class="site-footer border-top mt-auto">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                             
                            
                            <script>
                                
                            </script>Untuk info lebih lanjut, silahkan kontak kami<i
                                class="icon-heart" aria-hidden="true"></i> by <a href="https://api.whatsapp.com/send?phone=6289504959119&text=Hallo%20min%20saya%20ingin%20bertanya"
                                target="_blank" class="text-primary">Whatsapp!</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    @include('sweetalert::alert')
    @yield('js')

</body>

</html>
