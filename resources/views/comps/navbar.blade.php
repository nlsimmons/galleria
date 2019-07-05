<nav class="navbar is-dark">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <span class="title has-text-white">{{ env('APP_NAME') }}</span>
        </a>
    </div>

    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
            @auth
                <a href="{{ url('/home') }}" class="button is-primary">
                    My Page
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="button is-light">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="button is-primary">
                    Login
                </a>
                <a href="{{ route('register') }}" class="button is-light">
                    Sign Up
                </a>
            @endauth
            </div>
        </div>
    </div>
</nav>