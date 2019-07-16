<nav class="navbar is-dark is-fixed-top">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <span class="title has-text-white">{{ config('app.name') }}</span>
        </a>
    </div>
    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
                @auth
                    <a href="{{ url('/home') }}" class="button is-info">
                        Home
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="button is-light">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="button is-info">
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