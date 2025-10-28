<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">
    <title> @yield('title', 'Registrar Office (QSU)')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    @vite(['resources/css/app.css'])
    @yield('css')
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
</head>

<body class="fixed-sidebar">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side dark-skin" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header ">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="{{ asset('img/logo/qsu-dashboard.png') }}"
                                style="width: 50px; height: 50x; object-fit: cover;" />
                            <span class="block m-t-xs font-bold">{{ Auth::user()->name ?? 'Guest Name' }}</span>
                            <span class="text-muted text-xs block">{{ Auth::user()->role ?? 'Guest' }}</span>
                        </div>
                        <div class="dark-skin logo-element">
                            Registrar
                        </div>
                    </li>
                    <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.index') }}" class="text-white"><i class="fa fa-pie-chart"></i>
                            <span class="nav-label">Dashboard</span> </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.document') ? 'active' : '' }}">
                        <a href="{{ route('admin.document') }}" class="text-white"><i class="fa fa-file-text "></i>
                            <span class="nav-label">Request Documents</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.users-list') ? 'active' : '' }}">
                        <a href="{{ route('admin.users-list') }}" class="text-white"><i class="fa fa-users"></i>
                            <span class="nav-label">Users</span></a>
                    </li>
                    <li class="{{ request()->routeIs(['admin.new-settings', 'admin.history']) ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="text-white"><i class="fa fa-gear"
                                aria-hidden="true"></i>
                            <span class="nav-label">Settings</span><span class="fa arrow" aria-hidden="true"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">

                            <li class={{ request()->routeIs('admin.new-settings') ? 'active' : '' }}><a
                                    href="{{ route('admin.new-settings') }}">Account Settings</a></li>

                            <li class={{ request()->routeIs('admin.history') ? 'active' : '' }}><a
                                    href="{{ route('admin.history') }}">Activity Log</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                <nav class="navbar navbar-static-top dark-skin" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-success" href="#"><i
                                class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right ">
                        <li>
                            <a href="{{ route('logout') }}" class="text-white">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            @yield('content')
            <div class="footer">
                <div class="text-dark pull-right">
                    <strong">&copy;</strong> QSU Registrar Office
                </div>
            </div>

        </div>
    </div>
    @yield('script')
</body>

</html>
