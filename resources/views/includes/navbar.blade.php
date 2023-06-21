<div class="container">
    <nav class="navbar navbar-expand-lg bg-white">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ url('frontend/images/travelgo-logo1.png') }}" alt="" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navb"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav mx-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a class="nav-link" href="{{ route('travel') }}">Travel Package</a>
                </li>
                @auth
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="{{ route('history.index') }}">History</a>
                    </li>
                @endauth
            </ul>

            @guest
                <form class="form-inline my-2 my-lg-0 d-none d-md-block">
                    @csrf
                    <button class="btn btn-secondary btn-login mx-2" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">Log in</button>
                </form>
                <form class="form-inline my-2 my-lg-0 d-none d-md-block">
                    @csrf
                    <button class="btn btn-primary btn-register mx-2" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('register') }}';">Daftar</button>
                </form>
            @endguest

            @auth
                <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{  url('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-logout mx-2" type="submit">
                        Keluar
                    </button>
            @endauth
        </div>
    </nav>
</div>
