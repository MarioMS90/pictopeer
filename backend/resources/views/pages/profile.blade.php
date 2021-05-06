@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
@endpush

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
    <c:if test="${requestScope.fotoPredeterminada}">
        <div class="row mb-2 d-flex justify-content-center">
            <div class="col-md-6 offset">
                <div id="alert-info" class="alert alert-info text-center"
                     role="alert">
                    Para cambiar la foto de perfil pulsa sobre ella.
                </div>
            </div>
        </div>
    </c:if>
    <div class="row mb-4">
        <div class="col offset d-flex justify-content-center">
            <div class="card profile-card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a href="#" aria-label="Cambiar foto"
                           id="profile-img-button">
                            <div id="profile-img" class="profile-pic"
                                 style="background-image: url('https://i.imgur.com/${requestScope.usuario.fotoUrl}.jpg')">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Cambiar foto</span>
                            </div>
                        </a>
                        <input id="profile-img-input" type="file"
                               class="form-control" hidden/>
                    </div>
                    <h5 class="card-title d-flex justify-content-center mt-2 mx-5">
                        ${requestScope.usuario.alias}</h5>
                    <div
                        class="card-profile-stats d-flex justify-content-center mt-4 ml-2">
                        <div class="mx-3">
                            <span class="heading">${fn:length(requestScope.amigos)}</span>
                            <span class="description">Amigos</span>
                        </div>
                        <div class="mx-3">
                            <span class="heading">${fn:length(requestScope.publicaciones)}</span>
                            <span class="description">Publicaciones</span>
                        </div>
                        <div class="mx-3">
                            <span class="heading" id="likes">${requestScope.numeroLikes}</span>
                            <span class="description">Me gusta</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 offset">
            <ul class="nav nav-pills d-flex justify-content-center"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel1"
                       role="tab">
                        <i class="fas fa-user"></i>PUBLICACIONES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel2"
                       role="tab">
                        <i class="fas fa-user"></i>AMIGOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel3"
                       role="tab">
                        <i class="fas fa-heart"></i>PUBLICAR</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="row tab-pane fade in show active" id="panel1"
             role="tabpanel">
            <div class="container">
                <div class="row">
                    <c:forEach items="${requestScope.publicaciones}"
                               var="publicacion" varStatus="loop">
                        <div class="col-lg-4 col-md-6 mb-4 offset">
                            <a href='#' data-toggle="modal"
                               data-target="#carousel-modal"><img
                                    data-target="#carousel"
                                    data-slide-to="${loop.index}"
                                    src="https://i.imgur.com/${publicacion.urlID}.jpg"
                                    alt="..." class="img-fluid"></a>
                        </div>
                    </c:forEach>
                </div>
            </div>
        </div>
        <div class="row tab-pane fade" id="panel2" role="tabpanel">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-3 offset">
                        <div class="list-group">
                            <c:forEach items="${requestScope.amigos}"
                                       var="amigo">
                                <div
                                    class="list-group-item d-flex justify-content-between"
                                    id="friend-${amigo.id}">
                                    <img
                                        src="https://i.imgur.com/${amigo.fotoUrl}.jpg"
                                        alt="..."
                                        class="rounded-circle float-left">
                                    <a href="${pageContext.request.contextPath}/profile?u=${amigo.alias}">${amigo.alias}</a>
                                    <button type="button"
                                            class="btn btn-danger btn-sm btn-delete-friend"
                                            data-id="${amigo.id}">Eliminar
                                    </button>
                                </div>
                            </c:forEach>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row tab-pane fade" id="panel3" role="tabpanel">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-6 mb-4 offset">
                        <div id="alert"></div>
                        <button id="publication-img-button" type="button"
                                class="btn btn-dark btn-block">Seleccionar
                            imagen
                        </button>
                        <input id="publication-img-input" type="file"
                               name="image" class="form-control" hidden/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="carousel-modal" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"
             role="document">
            <div class="modal-content">
                <div id="carousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        <c:forEach items="${requestScope.publicaciones}"
                                   var="publicacion" varStatus="loop">
                            <div class="carousel-item <c:if test=" ${loop.first}
                            ">active</c:if>">
                            <div class="card">
                                <img class="card-img-top"
                                     src="https://i.imgur.com/${publicacion.urlID}.jpg"
                                     alt="...">
                                <div
                                    class="card-body d-flex justify-content-between">
                                    <div class="d-flex justify-content">
                                        <a href="#"><img
                                                id="like-button-${publicacion.id}"
                                                class="like btn-like <c:if test="
                                                ${publicacion.like== true}">display-none</c:if>
                                            " data-id="${publicacion.id}"
                                            src="${pageContext.request.contextPath}/images/icons/not-like.svg"
                                            alt=""></a>
                                        <a href="#"><img
                                                id="dislike-button-${publicacion.id}"
                                                class="like btn-dislike <c:if test="
                                                ${publicacion.like== false}">display-none</c:if>
                                            " data-id="${publicacion.id}"
                                            src="${pageContext.request.contextPath}/images/icons/like.svg"
                                            alt=""></a>
                                        <h6 id="like-number-${publicacion.id}"
                                            class="float">${publicacion.likes}
                                            Me gusta</h6>
                                    </div>
                                    <h6 class="float">${publicacion.fecha}</h6>
                                </div>
                            </div>
                    </div>
                    </c:forEach>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button"
                   data-slide="prev">
                    <span class="carousel-control-prev-icon"
                          aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button"
                   data-slide="next">
                    <span class="carousel-control-next-icon"
                          aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="publication-modal" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"
             role="document">
            <div class="modal-content">
                <button id="button-publish" type="button"
                        class="btn btn-dark btn-block btn-lg display-none"
                        data-toggle="modal" data-target="publication-modal">
                    Publicar
                </button>
                <img id="publication-img-preview" alt="..."
                     class="img-fluid display-none" src="...">
            </div>
        </div>
    </div>
@endsection
