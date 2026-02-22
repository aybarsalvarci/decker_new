<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Decker Admin | Signin</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=fallback">
    <link rel="stylesheet" href="{{asset('back/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/dist/css/adminlte.min.css')}}">

    <style>
        body.login-page {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Modern Gradient Arkaplan */
            font-family: 'Poppins', sans-serif;
            height: 100vh;
        }

        .login-box {
            width: 400px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
            border: none;
        }

        .card-header {
            border-bottom: none;
            padding-top: 30px;
        }

        .login-box-msg {
            font-weight: 300;
            color: #666;
        }

        .input-group-text {
            background-color: transparent;
            border-left: none;
            color: #764ba2;
        }

        .form-control {
            border-right: none;
            border-radius: 8px 0 0 8px;
            height: 45px;
        }

        .form-control:focus {
            border-color: #764ba2;
        }

        .input-group-append .input-group-text {
            border-radius: 0 8px 8px 0;
        }

        .btn-primary {
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            border-radius: 8px;
            height: 45px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }

        .lang-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .lang-switcher a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .lang-switcher a:hover {
            opacity: 1;
            font-weight: bold;
        }
    </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="card card-outline">
        <div class="card-header text-center">
            <a href="/" class="h1"><b style="color: #4e54c8;">Decker</b>Admin</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to access the control panel</p>

            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="input-group mb-4">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                          value="{{old('email')}}" placeholder="example@mail.com">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="input-group mb-4">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="**********">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password') <small class="text-danger">{{$message}}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            Signin
                        </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<script src="{{asset('back/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('back/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
