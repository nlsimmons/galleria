<nav class="navbar">
    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
            @auth
                <a href="{{ url('/home') }}" class="button is-primary">
                    My Page
                </a>
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