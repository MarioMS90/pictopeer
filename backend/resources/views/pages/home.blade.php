@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
@endpush

@section('header')
    @include('partials.navbar')
@endsection

@section('main')
    <main class="container">
        @if ( $user->new_user )
            @include('partials.welcome')
        @endif
        <section class="row">
            <aside class="col-lg-3">
                <div class="sticky-top mb-5">
                    <div class="card profile-card offset">
                        <div
                            class="card-header card-header d-flex justify-content-center align-items-center">
                            <img src="{{ $user->photo_profile_url }}"
                                 alt="Profile image"
                                 class="photo-profile-home rounded-circle">
                            <h5 class="title profile-title ml-3">{{ $user->alias }}</h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="suggest-header">
                                <h6 class="title">Sugerencias de amistad</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach ($friendSuggestions as $friendSuggestion)
                                    <li class="list-group-item d-flex justify-content-start align-items-center">
                                        <img
                                            src="{{ $friendSuggestion->photo_profile_url }}"
                                            alt="Profile image"
                                            class="rounded-circle">
                                        <h6 class="float"><a
                                                href="{{ route('profile.user', ['alias' => $friendSuggestion->alias]) }}"
                                                class="card-link">{{ $friendSuggestion->alias }}</a>
                                        </h6>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <section class="col-lg-9 offset">
                @foreach ($posts as $post)
                    <article class="card mb-5">
                        <div
                            class="card-header d-flex justify-content-start align-items-center">
                            <img src="{{ $post->photo_profile_url }}" alt="..."
                                 class="rounded-circle">
                            <h6 class="float">{{ $post->alias }}</h6>
                        </div>
                        <img class="card-img-top" src="{{ $post->photo_url }}"
                             alt="...">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex justify-content">
                                <a href="#"><img id="like-button-{{ $post->id }}"
                                                 class="like btn-like @if ($likesGiven->some($post->id)) display-none @endif"
                                                 data-id="{{ $post->id }}"
                                                 src="{{ URL::asset('images/icons/not-like.svg') }}"
                                                 alt=""></a>
                                <a href="#"><img id="dislike-button-{{ $post->id }}"
                                                 class="like btn-dislike @if (!$likesGiven->some($post->id)) display-none @endif"
                                                 data-id="{{ $post->id }}"
                                                 src="{{ URL::asset('images/icons/like.svg') }}"
                                                 alt=""></a>
                                <h6 id="like-number-${publicacion.id}"
                                    class="float">{{ $post->likeCount }} Me
                                    gusta</h6>
                            </div>
                            <h6 class="float">{{ $post->date }}</h6>
                        </div>
                    </article>
                @endforeach
            </section>
        </section>
    </main>
@endsection
