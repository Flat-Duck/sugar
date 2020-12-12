<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ mix('/css/admin/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/admin/app.css') }}" rel="stylesheet">

    {{-- You can put page wise internal css style in styles section --}}
    @stack('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body dir="rtl" class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        {{-- Header --}}
        <header class="main-header">

            {{--  Logo  --}}
            <a href="{{ route('doctor.dashboard') }}" class="logo">
                <span class="logo-mini">{{ config('app.name') }}</span>
                <span class="logo-lg">{{ config('app.name') }}</span>
            </a>

            {{--  Header Navbar  --}}
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        {{--  User Account Menu  --}}
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('images/admin-avatar.png') }}" class="user-image" alt="Admin avatar">

                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{ asset('images/admin-avatar.png') }}" class="img-circle" alt="Admin avatar">

                                    <p>{{ Auth::user()->name }}</p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('doctor.profile') }}" class="btn btn-default btn-flat">
                                            الملف الشخصي
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('doctor.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            {{--  Sidebar  --}}
            <section class="sidebar">

                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('images/admin-avatar.png') }}" class="img-circle" alt="Admin avatar">
                    </div>

                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                </div>

                {{--  Sidebar Menu  --}}
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU</li>

                    <li {{ $page == 'dashboard' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.dashboard') }}">
                            <i class="fa fa-building"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li {{ $page == 'patient' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.patients.index') }}">
                            <i class="fa fa-building"></i>
                            <span>المرضى</span>
                        </a>
                    </li>
                    <li {{ $page == 'move' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.patients.move') }}">
                            <i class="fa fa-building"></i>
                            <span>تحويل المرضى</span>
                        </a>
                    </li>
                    <li {{ $page == 'appointments' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.appointments.index') }}">
                            <i class="fa fa-building"></i>
                            <span>المواعيد</span>
                        </a>
                    </li>

                    <li {{ $page == 'chats' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.chats.index') }}">
                            <i class="fa fa-building"></i>
                            <span>المراسلات</span>
                        </a>
                    </li>
{{--
     
                    <li {{ $page == 'patients' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.providers.index') }}">
                            <i class="fa fa-arrow-right"></i>
                            <span>المرضى</span>
                        </a>
                    </li>

                    <li {{ $page == 'service' ? ' class=active' : '' }}>
                        <a href="{{ route('doctor.services.index') }}">
                            <i class="fa fa-arrow-right"></i>
                            <span>Services</span>
                        </a> 
                    </li>--}}
                </ul>
            </section>
        </aside>


        <div class="content-wrapper">
            {{--  Page header  --}}
            {{-- <section class="content-header">
                <h1>
                    @yield('title')
                </h1>
            </section> --}}

            {{--  Page Content  --}}
            <section class="content container-fluid">
                @if ($errors->all())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                @yield('content')
            </section>
        </div>

       
    </div>

    <script src="{{ mix('/js/admin/vendor.js') }}"></script>
    <script src="{{ mix('/js/admin/app.js') }}"></script>
    <script src="/js/jquery.dataTables.min.js"></script>

    @if (session('message'))
        <script>
            showNotice("{{ session('type') }}", "{{ session('message') }}");
        </script>
    @endif
    <script>
        $(function () {
         // $('#table').DataTable()
          $('#table').DataTable({
            'paging'      : false,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : false,
            'autoWidth'   : false
          })
        })
      </script>
    {{-- You can put page wise javascript in scripts section --}}
    @stack('scripts')
</body>
</html>