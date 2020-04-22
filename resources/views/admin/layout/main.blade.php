<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SGAM Admin</title>

        <!-- Styles -->
        <link href="{{asset('assets/css/lib/weather-icons.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/lib/themify-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/lib/menubar/sidebar.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/css/lib/helper.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    </head>

    <body>

        @include('admin.layout.sidebar')


        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
{{--                        <div class="float-left">--}}
{{--                            <div class="hamburger sidebar-toggle">--}}
{{--                                <span class="line"></span>--}}
{{--                                <span class="line"></span>--}}
{{--                                <span class="line"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="float-right">
                            <ul>
                                <li class="header-icon dib"><i class="ti-bell"></i>
                                    <div class="drop-down">
                                        <div class="dropdown-content-heading">
                                            <span class="text-left">Recent Notifications</span>
                                        </div>
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <div class="notification-content">
                                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                                            <div class="notification-heading">Mr. John</div>
                                                            <div class="notification-text">5 members joined today </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="text-center">
                                                    <a href="#" class="more-link">See All</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="header-icon dib"><span class="user-avatar">{{ Auth::user()->name }} <i class="ti-angle-down f-s-10"></i></span>
                                    <div class="drop-down dropdown-profile">
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li><a href="#"><i class="ti-user"></i> <span>Perfil</span></a></li>
                                                <li>
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                        <i class="ti-power-off"></i> <span>Cerrar sesión</span>
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- jquery vendor -->
        <script src="{{asset('assets/js/lib/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/lib/jquery.nanoscroller.min.js')}}"></script>
        <!-- nano scroller -->
        <script src="{{asset('assets/js/lib/menubar/sidebar.js')}}"></script>
        <script src="{{asset('assets/js/lib/preloader/pace.min.js')}}"></script>
        <!-- sidebar -->
        <script src="{{asset('assets/js/lib/bootstrap.min.js')}}"></script>

        <!-- bootstrap -->

        <script src="{{asset('assets/js/lib/circle-progress/circle-progress.min.js')}}"></script>
        <script src="{{asset('assets/js/lib/circle-progress/circle-progress-init.js')}}"></script>

        <script src="{{asset('assets/js/lib/morris-chart/raphael-min.js')}}"></script>
        <script src="{{asset('assets/js/lib/morris-chart/morris.js')}}"></script>
        <script src="{{asset('assets/js/lib/morris-chart/morris-init.js')}}"></script>

        <!--  flot-chart js -->
        <script src="{{asset('assets/js/lib/flot-chart/jquery.flot.js')}}"></script>
        <script src="{{asset('assets/js/lib/flot-chart/jquery.flot.resize.js')}}"></script>
        <script src="{{asset('assets/js/lib/flot-chart/flot-chart-init.js')}}"></script>
        <!-- // flot-chart js -->

        <script src="{{asset('assets/js/lib/weather/jquery.simpleWeather.min.js')}}"></script>
        <script src="{{asset('assets/js/lib/weather/weather-init.js')}}"></script>
        <script src="{{asset('assets/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
        <script src="{{asset('assets/js/scripts.js')}}"></script>
        <!-- scripit init-->

    </body>

</html>
