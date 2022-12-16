<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="edicode" />
    <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <title>@yield('title') - Admin Desa Kalibaru </title>

    @yield('css')
</head>

<body>
    <div id="wrapper">
        @include('layouts/admin/left_side_bar_view')
        <div id="page-wrapper" class="gray-bg">
            @include('layouts/admin/header_view')
            <div style="clear: both; height: 61px;"></div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inqbox float-e-margins">
                            <div class="inqbox-content">
                                @yield('bread')
                            </div>
                        </div>
                    </div>
                </div>
                @yield('main')   
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> edicode &copy; 2021
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @include('sweetalert::alert')
    @yield('js')

    <script type="text/javascript">
        $('#btn-logout').click(function(e) {
          e.preventDefault();
          $('#formLogout').submit();
        });
    </script>

</body>

</html>