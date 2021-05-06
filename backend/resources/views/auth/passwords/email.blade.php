@extends('partials.login-card')

@section('form')
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    @if (session('status'))
        <p class="alert alert-success">{{ session('status') }}</p>
    @endif
    <div class="form-group form-label-group">
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <label for="email">Email</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">
        Enviar email de recuperación
    </button>
    <hr class="my-4">
    <h6 class="bold"><a href="{{ route('login') }}" class="bottom">Volver</a></h6>
</form>
@endsection
