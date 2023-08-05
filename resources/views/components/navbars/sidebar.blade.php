<!-- ======= Sidebar ======= -->
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Login - Laravel Boilerplate</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="{{ asset('assets') }}/img/favicon.png" rel="icon">
<link href="{{ asset('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">
<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
<!-- Vendor CSS Files -->
<link href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('assets') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="{{ asset('assets') }}/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="{{ asset('assets') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="{{ asset('assets') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="{{ asset('assets') }}/vendor/simple-datatables/style.css" rel="stylesheet">
<!-- Template Main CSS File -->
<link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }} ">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- this role assigned at the time of user creation if you to access this section to user role the use user role name  -->
        @role('admin')
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>User Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.index') }}">
                        <i class="bi bi-circle"></i><span>Users</span>
                    </a>
                </li>
            </ul>
        </li><!-- End User management Nav -->
        @endrole


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>CRUD Operation</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('crud.index') }}">
                        <i class="bi bi-circle"></i><span>CRUD</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav  -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Example Menu</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Example One</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Example Two</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-person"></i>
                <span>Page One</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->

@push('js')
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="{{ asset('assets') }}/vendor/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets') }}/vendor/chart.js/chart.umd.js"></script>
<script src="{{ asset('assets') }}/vendor/echarts/echarts.min.js"></script>
<script src="{{ asset('assets') }}/vendor/quill/quill.min.js"></script>
<script src="{{ asset('assets') }}/vendor/simple-datatables/simple-datatables.js"></script>
<script src="{{ asset('assets') }}/vendor/tinymce/tinymce.min.js"></script>
<script src="{{ asset('assets') }}/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="{{ asset('assets') }}/js/main.js"></script>
@endpush