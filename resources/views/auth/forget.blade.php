<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-image: url('{{ asset('') }}img/img-sementara.jpeg');
        background-repeat: no-repeat;
        background-position: center;
        width: 100%;
        -webkit-background-size: cover;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPRINT | FORGET PASSWORD</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!------------------------ Favicon ----------------------------->
        <link rel="icon" href="{{ asset('new-kemenperin.ico') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            
            <div class="card-body">
               
                <p class="login-box-msg">Lupa Password</p>
                @include('include.admin.alert')
                @if ($errors->has('captcha'))
                    <div class="alert alert-danger">
                        Captcha Salah !
                    </div>
                @endif
                <form action="#" method="POST">
                    
                    @csrf
                    <div class="input-group mb-3">
                        <input id="first" type="text" name="email" class="form-control" placeholder="Email Admin" required>

                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            
                               <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img" data-refresh-config="default">
                               <i style="margin-left: 10px; padding-right:15px; margin-top:10px;" id="refresh-captcha" class="fas fa-sync-alt"></i>
                           
                        </div>
                        <input type="text" name="captcha" class="form-control" placeholder="Captcha" required>
                        
                    </div>
                    <div class="row">
                        <div class="col-8">
                            
                               <a href="{{ route('login') }}" class="btn btn-default">Kembali</a>
                            
                        </div>
                        <!-- /.col -->
                        
                        <div class="col-4">
                            
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <p class="mb-1">
                       
                    </p>
                </form>



               
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script>
        function myFunction() {
            var x = document.getElementById("inputPassword");
            var z = document.getElementById("iconPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            if (z.className === "fas fa-eye") {
                z.className = "fas fa-eye-slash";
            } else {
                z.className = "fas fa-eye";
            }
        }
        window.onload = function() {
            document.getElementById("first").focus();
        };
        var inputs = document.querySelectorAll("input,select");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener("keypress", function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    var nextInput = document.querySelectorAll('[tabIndex="' + (this.tabIndex + 1) + '"]');
                    if (nextInput.length === 0) {
                        nextInput = document.querySelectorAll('[tabIndex="1"]');
                    }
                    nextInput[0].focus();
                }
            })
        }

         document.getElementById('refresh-captcha').onclick = function(e) {
            e.preventDefault();
            var captchaImage = document.querySelector('.captcha-img');
            captchaImage.src = '{{ url("/captcha?rnd='+Math.random()+'") }}'
        };
    </script>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>


</body>

</html>