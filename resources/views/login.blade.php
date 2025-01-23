<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | @include('component.nameapp')</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body data-bs-theme="dark">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">@include('component.nameapp')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a style="color:#fff;" class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-5">
    <section>
        <div class="container">
            <h3 class="mb-3 text-center">Login</h3>

            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('component.notif')
                            <form action="{{route('dologin')}}" method="post">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}" required autofocus/>
                                </div>
                                @error('username')
                                <div class="form-text text-danger">
                                    {{$message}}
                                </div>
                                 @enderror
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" required value="{{old('password')}}" class="form-control"/>
                                </div>
                                @error('password')
                                <div class="form-text text-danger">
                                    {{$message}}
                                </div>
                                 @enderror
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <p class="text-center">You have no an account yet? <a href="{{route('register')}}">Register</a></p>
                </div>
            </div>

        </div>
    </section>
</main>

</body>
</html>