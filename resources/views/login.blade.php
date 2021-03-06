<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"  href="{{asset('/assets/css/bootstrap.css')}}">
    <link rel="stylesheet"  href="{{asset('/assets/css/main.css')}}">
    <title>Dasturlar</title>
</head>
<body class="login-body">
<header class="d-flex justify-content-center align-items-center flex-column min-vh-100" >
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{route(Route::currentRouteName(),'en')}}" class="nav-link">EN</a>
        </li>
        <li class="nav-item">
            <a href="{{route(Route::currentRouteName(),'uz')}}" class="nav-link">UZ</a>
        </li>
        <li class="nav-item">
            <a href="{{route(Route::currentRouteName(),'ru')}}" class="nav-link">RU</a>
        </li>
    </ul>
    <img src="{{asset('/assets/images/Logo-center2.png')}}" alt="svg">

    <!-- Login Title Top block-section-->
    <div class="col-md-4 text-center px-5 pb-5">
        <p class="login-title-text darkblue-color mb-5">@lang('login.title')</p>
    </div>
    <!-- Form Center block-section-->
    <div class="pt-4 pb-5 mb-5 px-4 align-items-center justify-content-center bg-white login-box">

        <div class="d-flex justify-content-center flex-column h-100">
            <form method="POST" action="{{ route('login',app()->getLocale()) }}" class="login-form px-3">
                @csrf
                <div class="form-group w-100">
                    <label for="login" class="mb-0 text-left font-weight-bolder darkblue-color">@lang('login.mail')</label>
                    <input class="login-input form-control" placeholder="{{__('login.enterLogin')}}" id="login" type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group w-100">
                    <label for="password" class="mb-0 text-left font-weight-bolder darkblue-color">@lang('login.password')</label>
                    <input class="login-input form-control" placeholder="{{__('login.enterPassword')}}" id="password" type="password" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button class="login-button">
                    @lang('login.enter')
                </button>
            </form>
        </div>


    </div>

    <!-- Footer Login Socials Bottom block-section-->

    <ul class="text-center mt-5 pt-5">
        <li>
            <p class="login-help-texts darkblue-color number-title mb-0">@lang('login.support'):</p>
        </li>
        <li>
            <p class="login-help-texts darkblue-color number-login">(+998 71) 123-45-67</p>
        </li>
        <li class="d-flex align-items-center justify-content-center">
            <a href="#" class="text-decoration-none mx-3">
                <img src="{{asset('/assets/images/tg-logo.svg')}}" alt="svg">

            </a>
            <a href="#" class="text-decoration-none mx-3">
                <img src="{{asset('/assets/images/social-icon.svg')}}" alt="svg">
            </a>
        </li>
    </ul>

</header>
</body>
</html>