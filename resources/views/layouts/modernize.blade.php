<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NBB | @yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('images/logo.png')}}" />
    <link rel="stylesheet" href="{{ asset('modernize/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
    <link rel="stylesheet" href="{{ asset('library/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/tabler/tabler.min.css') }}">
    <link rel="stylesheet" href="{{asset('library/toastify/toastify.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <div class="brand-container">
                        <img class="brand-img" src="{{ asset('images/banner.png') }}" alt="" />
                    </div>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu text-primary">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ menu_active('/admin/dashboard') }}"
                                href="{{ route('dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu text-primary">System</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ menu_active('/admin/user') }}"
                                href="{{ route('user.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Users</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div>Welcome, <span class="text text-info">{{ auth()->user()->name }}</span></div>
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/admin.png') }}" alt=""
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a class="dropdown-item btn
                    btn-outline-primary mt-2 d-block"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="my-ratio">
               <div>
                    @yield('content')
               </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('modernize/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('modernize/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('modernize/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('modernize/js/app.min.js') }}"></script>
    <script src="{{ asset('modernize/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('library/select2/select2.min.js') }}"></script>
    <script src="{{ asset('library/flatpickr/flatpickr.js') }}"></script>
    <script src="{{asset('library/toastify/toastify.js')}}"></script>
    <script src="{{ asset('library/sweetAlert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('js')
</body>

</html>
