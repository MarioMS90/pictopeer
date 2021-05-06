<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ URL::asset('images/logo-only.png') }}" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarColor02" aria-controls="navbarColor02"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto float-left">
                <li class="nav-item {{  Route::currentRouteName() == 'home' ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item mr-5 {{  Route::currentRouteName() == 'profile' ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('profile') }}">Perfil</a>
                </li>
                <li class="nav-item">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search"
                               placeholder="Buscar personas"
                               aria-label="Search">
                        <button type="button"
                                class="btn btn-outline-secondary my-2 my-sm-0">
                            Buscar
                        </button>
                    </form>
                </li>
            </ul>
            <div class="d-flex justify-content-center">
                <div>
                    <button data-toggle="dropdown" type="button"
                            class="btn btn-sm btn-secondary notifications mt-1">
                        Notificaciones <span id="notify-number"
                                             class="badge badge-light">{{ count($notifications) }}</span>
                    </button>
                    <div class="dropdown">
                        <div class="dropdown-menu dropdown-menu-right">
                            @if ( count($friendRequests) == 0 )
                                <h5 class="dropdown-header">Sin solicitudes de
                                    amistad</h5>
                            @else
                                <h5 class="dropdown-header">Solicitudes de
                                    amistad</h5>
                            @endif
                            @foreach ($friendRequests as $friendRequest)
                                <div class="friendRequest"
                                     data-id="{{ $friendRequest->id }}">
                                    <div class="dropdown-divider"></div>
                                    <div class="mx-4">
                                        <h6>{{ $friendRequest->alias }}</h6>
                                        <div
                                            class="d-flex justify-content-around">
                                            <a href="#"
                                               class="btn-friend-request-accept"
                                               data-id="{{ $friendRequest->id }}">Aceptar</a>
                                            <a href="#"
                                               class="btn-friend-request-reject"
                                               data-id="{{ $friendRequest->id }}">Rechazar</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <a href='#' data-toggle="dropdown">
                        <img src="{{ $user->photo_profile_url }}"
                             alt="Profile image"
                             class="photo-nav rounded-circle ml-2">
                    </a>
                    <div class="dropdown">
                        <div class="dropdown-menu dropdown-menu-right">
                            <h5 class="dropdown-header d-flex justify-content-center">
                                {{ $user->alias }}</h5>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="{{ route('profile') }}">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="{{ route('logout') }}" id="a-sign-out">Cerrar
                                sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
