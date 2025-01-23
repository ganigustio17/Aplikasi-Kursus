<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | @include('component.nameapp')</title>
    @include('component.style')
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
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a style="color:#fff;" class="nav-link" href="#">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="py-5">
    <section>
        <div class="container">
            @include('component.notif')
            <h3 class="mb-3 text-center">Register</h3>
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{route('doregister')}}" method="post">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control" required autofocus/>
                                </div>
                                @error('full_name')
                                    <div class="form-text text-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                                <div class="form-group mb-2">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" required class="form-control"/>
                                </div>
                                @error('username')
                                <div class="form-text text-danger">
                                    {{$message}}
                                </div>
                                 @enderror
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" required class="form-control"/>
                                </div>
                                @error('password')
                                <div class="form-text text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <div class="form-group mb-2">
                                    <label for="password">Password Confirmation</label>
                                    <input type="password" name="password_confirm" id="password" required class="form-control"/>
                                </div>
                                @error('password_confirm')
                                <div class="form-text text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <p class="text-center">You have an account? <a href="{{route('login')}}">Login</a></p>
                </div>
            </div>

        </div>
    </section>
</main>
@include('component.notif')
</body>
</html>
