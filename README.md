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

## Descripción

Esta app consiste en una red social donde los usuarios pueden publicar imágenes añadiendoles etiquetas o hashtags, agregar a otros usuarios como amigos, buscar a otros usuarios para visitar sus perfiles y dar Me Gusta a sus publicaciones.

### Página de login
<p align="center">
  <img src="https://i.imgur.com/PWpoMCW.png" width="340" alt="Pictopeer Login" />
</p>

Al entrar en la web lo primero que se requerirá es un inicio de sesión o registro, esta autenticación se realiza mediante token de autorización (JWT), una vez que el usuario introduce sus credenciales estos son enviados al backend mediante POST, si los datos son correctos el frontend recibe como respuesta un token que identifica de manera única al usuario y que se guarda en una base de datos local (localStorage), a partir ahí todas las acciones que el usuario realice en la web y que requieran peticiones al backend deberán llevar ese token incluido como firma en el header, para conseguir esto utilizo un interceptor desde Angular que se encarga de incluir este token en los headers de cada petición que sale desde el frontend, en la parte del backend he utilizado una biblioteca llamada jwt-auth que se encarga de generar y validar los tokens de autorización.

### Página de perfil
<p align="center">
  <img src="https://i.imgur.com/OOZ9dFv.png" width="640" alt="Pictopeer Profile" />
</p>

En la página de perfil se puede ver un resumen de estadísticas del usuario, que son la cantidad de amigos y de publicaciones así como los Me Gusta recibidos, también se mostraran todas las publicaciones del usuario, si además estamos viendo nuestro propio perfil podremos cambiar la imagen desde ahí haciendo click sobre la foto.

En la página principal (Inicio) de la web, los usuarios recibirán sugerencias de amistad y se mostrará una lista de publicaciones, esta lista se genera combinando las publicaciones de los amigos del usuario con las publicaciones recomendadas y ordenandolas por fecha descendente, la lista se va mostrando mediante auto scroll infinito, para esto uso la biblioteca ngx-infinite-scroll que se encarga de detectar el scroll hecho por el usuario y de realizar las peticiones al backend cuando es necesario, en la parte backend he utilizado una biblioteca para Laravel de paginación mediante cursores llamada cursor-pagination, esta biblioteca se encarga de calcular el proximo cursor de la consulta de publicaciones y de incluirlo en la respuesta hacia el frontend, de manera que en la siguiente consulta se debe de incluir nuevamente este cursor para que el backend sepa cual es la última publicación que consultó.

Las sugerencias de amistad y de publicaciones estarán basadas en diferentes criterios según la actividad del usuario dentro de la página, es decir, estos algoritmos irán cambiando en tiempo de ejecución y solo se utilizará uno de ellos a la vez, lo cual lo hace ideal para el uso del patrón Strategy.

El patrón Strategy es un patrón de comportamiento que permite mantener un conjunto de algoritmos de entre los cuales el objeto cliente puede elegir aquel que le conviene e intercambiarlo dinámicamiente según sus necesidades.

Existen tres tipos de algoritmos de recomendación:

- Basados en amigos mutuos.
- Basados en hashtags de publicaciones.
- Basados en popularidad.

Estos algoritmos se escogen por los clientes (PostController y UserController) dependiendo de los siguientes criterios:

- Si el usuario t

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
