@extends('layouts.app')

@section('content')

<section class="section">

    <div class="container">
        <h3 class="title">{{ __('Login') }}</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="field">
                <label for="password" class="label">{{ __('Password') }}</label>
                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox" for="remember">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-link">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="button is-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
