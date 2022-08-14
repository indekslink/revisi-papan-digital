<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Papan Digital Desa Tikusan Kecamatan Kapas</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('/')}}vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/')}}css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        #wrapper::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -9999999;
            background-color: white;
            opacity: 0;
            transition: .5s ease-in-out;
        }

        #wrapper.change-page::before {
            opacity: 1;
            z-index: 9999999999;
        }
    </style>
    @yield('style')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="change-page">

        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('partials.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('heading')

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('/')}}vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('/')}}vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/')}}js/sb-admin-2.min.js"></script>
    <script>
        window.onbeforeunload = function(event) {
            loadingChangePage()
        }
        window.onload = function() {
            loadingChangePage()
        }

        function loadingChangePage() {

            return document.querySelector('#wrapper').classList.toggle('change-page')
        }

        function myAlert(icon, title) {
            return `<div class="alert alert-${icon} alert-dismissible fade show" role="alert">
                    ${title}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>`
        }

        function handledSubmit(form, btn) {
            const button = document.querySelector(btn)
            button.disabled = true;
            button.textContent = 'Loading...';
            form.submit();
        }
    </script>
    @yield('script')

</body>

</html>