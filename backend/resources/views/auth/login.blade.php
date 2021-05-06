@extends('partials.login-card')

@section('form')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group form-label-group">
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <label for="email">Email</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group form-label-group">
        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required autocomplete="current-password">
        <label for="password">Contraseña</label>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">
        Iniciar sesión
    </button>
    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="btn btn-lg btn-secondary btn-block text-uppercase">
            ¿Contraseña olvidada?
        </a>
    @endif
    <hr class="my-4">
    <h6 class="bold text-dark">Si no tienes cuenta puedes <a href="{{ route('register') }}" class="bottom">registrarte</a></h6>
</form>
@endsection
