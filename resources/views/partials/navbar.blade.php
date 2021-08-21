<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ __('public.navbar title') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">{{ __('public.home') }}</a>
                </li>
            </ul>
            @guest
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-outline-success mx-2"
                       type="submit">{{ __('public.login') }}</a>
                    <a href="{{ route('auth.register.form') }}" class="btn btn-outline-success mx-2"
                       type="submit">{{ __('public.register') }}</a>
                </div>
            @endguest
            @auth
                <p>welcome Dear!</p>
            @endauth
        </div>
    </div>
</nav>
