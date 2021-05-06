@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
@endpush

@section('main')
    <main class="container">
        <section class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img class="mb-4 card-img-top logo"
                                 src="{{ URL::asset('images/logo.png') }}"
                                 alt="logo"/>
                        </div>
                        <div class="logreg-forms">
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
