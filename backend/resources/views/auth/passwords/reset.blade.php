@extends('partials.login-card')

@section('form')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group form-label-group">
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        <label for="email">Email</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group form-label-group">
        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password" autofocus>
        <label for="password">Contraseña</label>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group form-label-group">
        <input type="password" id="password-confirm" name="password_confirmation" class="form-control @error('password-confirm') is-invalid @enderror" placeholder="Confirmar contraseña" required autocomplete="new-password" autofocus>
        <label for="password-confirm">Confirmar contraseña</label>
        @error('password-confirm')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">
        Cambiar contraseña
    </button>
</form>
@endsection
