<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{ trans('front/site.title') }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

@yield('head')

<!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style>
        /* Style the tab buttons */
        .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 33.3333%;
        }

        /* Change background color of buttons on hover */
        .tablink:hover {
            background-color: #777;
        }

        /* Set default styles for tab content */
        .tabcontent {
            color: white;
            display: none;
            padding: 50px;
            text-align: center;
        }





    </style>
</head>

<body>





<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://laravel.joeyvanvenrooij.nl" class="simple-text">
                    {{ trans('front/site.title') }}
                </a>
            </div>



            <ul class="nav">
                <li {!! classActivePath('/') !!}>
                    {!! link_to('/', trans('front/site.home')) !!}
                </li>
                @if(session('statut') == 'visitor' || session('statut') == 'user')
                    <li {!! classActivePath('contact/create') !!}>
                        {!! link_to('contact/create', trans('front/site.contact')) !!}
                    </li>
                @endif
                @if(Request::is('auth/register'))
                    <li class="active">
                        {!! link_to('auth/register', trans('front/site.register')) !!}
                    </li>
                @elseif(Request::is('password/email'))
                    <li class="active">
                        {!! link_to('password/email', trans('front/site.forget-password')) !!}
                    </li>
                @else
                    @if(session('statut') == 'visitor')
                        <li {!! classActivePath('login') !!}>
                            {!! link_to('login', trans('front/site.connection')) !!}
                        </li>
                    @else
                        @if(session('statut') == 'admin')
                            <li>
                                {!! link_to('admin/nodes', "Node management") !!}
                            </li>
                        @elseif(session('statut') == 'redac')
                            <li>
                                {!! link_to('admin/nodes', "Node management") !!}
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}" id="logout">
                                <span class="fa fa-fw fa-power-off"></span>
                                {{ trans('back/admin.logout') }}
                            </a>
                        </li>
                    @endif
                @endif
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('img/' . session('locale') . '-flag.png') !!}" />&nbsp; <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @foreach ( config('app.languages') as $user)
                            @if($user !== config('app.locale'))
                                <li><a href="{!! url('language') !!}/{{ $user }}"><img width="32" height="32" alt="{{ $user }}" src="{!! asset('img/' . $user . '-flag.png') !!}"></a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content">
            @if(session()->has('ok'))
                @include('partials/error', ['type' => 'success', 'message' => session('ok')])
            @endif
            @if(isset($info))
                @include('partials/error', ['type' => 'info', 'message' => $info])
            @endif
            @yield('main')
        </main>





        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li {!! classActivePath('/') !!}>
                            {!! link_to('/', trans('front/site.home')) !!}
                        </li>
                        @if(session('statut') == 'visitor' || session('statut') == 'user')
                            <li {!! classActivePath('contact/create') !!}>
                                {!! link_to('contact/create', trans('front/site.contact')) !!}
                            </li>
                        @endif

                        @if(Request::is('auth/register'))
                            <li class="active">
                                {!! link_to('auth/register', trans('front/site.register')) !!}
                            </li>
                        @elseif(Request::is('password/email'))
                            <li class="active">
                                {!! link_to('password/email', trans('front/site.forget-password')) !!}
                            </li>
                        @else
                            @if(session('statut') == 'visitor')
                                <li {!! classActivePath('login') !!}>
                                    {!! link_to('login', trans('front/site.connection')) !!}
                                </li>
                            @else
                                @if(session('statut') == 'admin')
                                    <li>
                                        {!! link_to('admin/nodes', "Node management") !!}
                                    </li>
                                @elseif(session('statut') == 'redac')
                                    <li>
                                        {!! link_to('admin/nodes', "Node management") !!}
                                    </li>
                                @endif
                                <li>
                                    {!! link_to('/logout', trans('front/site.logout'), ['id' => "logout"]) !!}
                                    {!! Form::open(['url' => '/logout', 'id' => 'logout-form']) !!}{!! Form::close() !!}
                                </li>
                            @endif
                        @endif
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.laravel.joeyvanvenrooij.nl">Joey</a>
                </p>
            </div>
        </footer>

    </div>
</div>
</div>


{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js') !!}
{!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
        $('#logout').click(function(e) {
            e.preventDefault();
            $('#logout-form').submit();
        })
    });
</script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="/assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Charts Plugin -->
<script src="/assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="/assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="/assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="/assets/js/demo.js"></script>

@yield('scripts')


</body>





</html>