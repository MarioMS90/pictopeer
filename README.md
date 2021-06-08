<p align="center">
  <img src="https://i.imgur.com/BTF46wP.png" width="240" alt="Pictopeer Logo" />
</p>

[travis-image]: https://api.travis-ci.org/nestjs/nest.svg?branch=master
[travis-url]: https://travis-ci.org/nestjs/nest
[linux-image]: https://img.shields.io/travis/nestjs/nest/master.svg?label=linux
[linux-url]: https://travis-ci.org/nestjs/nest

<p align="center">Una red social para publicar y compartir imágenes realizada en Angular y Laravel.</p>
<p align="center">Proyecto final del FP de Desarrollo de Aplicaciones Web.</p>
<p align="center">
<img src="https://img.shields.io/badge/Laravel-v6.20-orange" alt="Laravel Version" />
<img src="https://img.shields.io/badge/Angular-v9.1.12-red" alt="Angular Version" />
<img src="https://img.shields.io/badge/Bootstrap-v4.5.0-blue" alt="Bootstrap Version" />
<img src="https://img.shields.io/badge/MySQL-v5.7.22-lightgrey" alt="MySQL Version" />
<img src="https://img.shields.io/npm/l/@nestjs/core.svg" alt="App License" />
</p>

## Description

El proyecto consiste en una red social donde los usuarios pueden publicar imágenes añadiendoles etiquetas o hashtags, agregar a otros usuarios como amigos, buscar a otros usuarios para visitar sus perfiles y dar Me Gusta a sus publicaciones.

Al entrar en la web lo primero que se requerirá es un inicio de sesión o registro, esta autenticación se realiza mediante token de autorización (JWT), para ello, una vez el usuario introduce sus datos estos son enviados al backend mediante POST, si los datos son correctos el frontend recibe como respuesta un token que identifica de manera única al usuario y que se guarda en una base de datos local (localStorage), a partir de ese momento todas las acciones que el usuario realice en la web y que requieran peticiones al backend deberán llevar ese token incluido como firma en el header, para conseguir esto utilizo un interceptor desde Angular que se encarga de incluir este token en los headers de cada petición que sale desde el frontend, en la parte del backend he utilizado una biblioteca llamada jwt-auth que se encarga de generar y validar los tokens de autorización.

En la página principal (Inicio) de la web, los usuarios recibirán sugerencias de amistad y se mostrará un tablon de publicaciones con auto scroll infinito, para esto en la parte front he utilizado la biblioteca ngx-infinite-scroll que se encarga de detectar el scroll hecho por el usuario y de realizar las peticiones al backend cuando es necesario, en la parte backend he utilizado una biblioteca para Laravel de paginación mediante cursores llamada cursor-pagination, esta biblioteca se encarga de generar el proximo cursor de la consulta  a incluir en la respuesta junto co

que estarán basadas en diferentes criterios según la actividad del usuario dentro de la página, es decir, estos algoritmos irán cambiando en tiempo de ejecución, para esto he utilizado el patrón strategy 

## Instalación

Install project dependencies and start a local server with the following terminal commands:

```bash
$ npm install
$ npm run start
```

Navigate to [`http://localhost:4200/`](http://localhost:4200/).

## Contacto

Autor - [Mario Muñoz Serrano](https://github.com/MarioMS90)

## Licencia

Pictopeer es [licencia MIT](LICENSE).
