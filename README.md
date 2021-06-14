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

La parte backend está hecha con Laravel, los modelos actuan como su propio servicio como es convención en laravel, existen 4 controladores: 
- AuthController: Contiene los endpoints de login y registro.
- UserController: Contiene los endpoints para todo lo relacionado con el usuario.
- PostController: Contiene los endpoints para todo lo relacionado con las publicaciones.
- ImageController: Se encarga de la subida de imagenes tanto de publicaciones como de fotos de perfil a través de la API de Imgur.

La parte frontend se ha realizado con Angular, está dividida en 3 modulos que son el modulo de autenticación, la página home y la página de perfil, además existen tres servicios que son:
- AuthService: Para las operaciones de autenticación.
- UserService: Para las operaciones relacionadas con el usuario.
- PostService: Para las operaciones relacionadas con las publicaciones.

## Página de login
<p align="center">
  <img src="https://i.imgur.com/OxPqwBf.png" width="340" alt="Pictopeer Login" />
</p>

Al entrar en la web lo primero que se requerirá es un inicio de sesión o registro, esta autenticación se realiza mediante token de autorización (JWT), una vez que el usuario introduce sus credenciales estos son enviados al backend mediante POST, si los datos son correctos el frontend recibe como respuesta un token que identifica de manera única al usuario y que se guarda en una base de datos local (localStorage), a partir ahí todas las acciones que el usuario realice en la web y que requieran peticiones al backend deberán llevar ese token incluido como firma en el header, para conseguir esto utilizo un interceptor desde Angular que se encarga de incluir este token en los headers de cada petición que sale desde el frontend, en la parte del backend he utilizado una biblioteca llamada jwt-auth que se encarga de generar y validar los tokens de autorización.

## Página de perfil
<p align="center">
  <img src="https://i.imgur.com/OOZ9dFv.png" width="640" alt="Pictopeer Profile" />
</p>

En la página de perfil se puede ver un resumen de estadísticas del usuario, estas son la cantidad de amigos y de publicaciones así como los Me Gusta recibidos, también se mostraran todas las publicaciones del usuario, si además estamos viendo nuestro propio perfil podremos cambiar la imagen desde ahí haciendo click sobre la foto.

Si estamos viendo el perfil de otro usuario nos aparecerá un botón para enviarle una solicitud de amistad.

## Barra de navegación
<p align="center">
  <img src="https://i.imgur.com/x6DMMNs.png" width="640" alt="Pictopeer Navbar" />
</p>

La barra de navegación que se muestra en todas las páginas permite navegar por la web, además contiene una barra de búsqueda de usuarios con autocompletado hecho con la biblioteca Ngx-Angular-Autocomplete, al buscar cualquier usuario nos llevará a su perfil.

Por otro lado también podremos ver las notificaciones, que pueden ser de dos tipos, solicitudes de amistad (que podremos aceptar o rechazar desde ahí) y likes nuevos recibidos, estas últimás solo se notificarán la primera vez hasta que el usuario las vea.
<p align="center">
  <img src="https://i.imgur.com/Xy6znWy.png" width="240" alt="Pictopeer Notifications" />
</p>

## Amigos
<p align="center">
  <img src="https://i.imgur.com/a5jSyMp.png" width="640" alt="Pictopeer Friends" />
</p>

Desde esta página podremos ver nuestra lista de amigos y tendremos la opción de eliminarlos.


## Publicar
<p align="center">
  <img src="https://i.imgur.com/YZJlNct.png" width="640" alt="Pictopeer Publish" />
</p>

Aquí podremos realizar nuevas publicaciones, previsualizar la imagen y añadirles los hashtags que deseemos.

## Home
<p align="center">
  <img src="https://i.imgur.com/mp3kBEo.png" width="640" alt="Pictopeer Publish" />
</p>
En la página principal (Inicio) de la web, los usuarios recibirán sugerencias de amistad y se mostrará una lista de publicaciones, esta lista se genera combinando las publicaciones de los amigos del usuario con las publicaciones recomendadas y ordenandolas por fecha descendente, la lista se va mostrando mediante auto scroll infinito, para esto uso la biblioteca Ngx-infinite-scroll que se encarga de detectar el scroll hecho por el usuario y de realizar las peticiones al backend cuando es necesario, en la parte backend he utilizado una biblioteca para Laravel de paginación mediante cursores llamada Cursor-pagination, esta biblioteca se encarga de calcular el proximo cursor de la consulta de publicaciones y de incluirlo en la respuesta hacia el frontend de manera que en la siguiente consulta se debe de incluir nuevamente este cursor para que el backend sepa cual es la última publicación que consultó.Las sugerencias de amistad y de publicaciones estarán basadas en diferentes criterios según la actividad del usuario dentro de la página, es decir, estos algoritmos irán cambiando en tiempo de ejecución y solo se utilizará uno de ellos a la vez, lo cual lo hace ideal para el uso del patrón Strategy.

El patrón Strategy es un patrón de comportamiento que permite mantener un conjunto de algoritmos de entre los cuales el objeto cliente puede elegir aquel que le conviene e intercambiarlo dinámicamiente según sus necesidades.

Existen tres tipos de algoritmos de recomendación:

- Basados en amigos mutuos:
  - Sugerencias de amistad de usuarios que comparten amigos en común.
  - Recomienda publicaciones de estos mismos usuarios.
- Basados en hashtags.
  - Sugerencias de amistad de usuarios que suben publicaciones con los hashtags que mas gustan al usuario, es decir, si el usuario suele dar mas Me Gusta a           fotos con el hashtag #playa, se le recomiendan usuarios que suben mas publicaciones con ese mismo hashtag.
  - Recomienda sugerencias de publicaciones de estos mismos usuarios. 
- Basados en popularidad.
  - Sugerencias de amistad de usuarios que tienen mas amigos.
  - Recomienda las publicaciones con mas cantidad de Me Gusta.

Estos algoritmos se escogen por los clientes (PostController y UserController) dependiendo de una serie de criterios, cada uno de estos controladores tienen una función switch (getPostSuggesterByUserState y getFriendSuggesterByUserState) que comprueban el estado del usuario y entregan una instancia de uno de estos recomendadores haciendo uso de un patrón factory (SuggesterFactory), estos criterios son:

- Si el usuario tiene amigos:
  - Sugerencias de amistad basadas en amigos mutuos.
  - Sugerencias de publicaciones basadas, pero si el usuario no ha otorgado ningún Me Gusta.

- Si el usuario ha otorgado algún Me Gusta:
  - Sugerencias de amistad basadas en amigos mutuos, pero solo si el usuario no tiene amigos.
  - Sugerencias de publicaciones basadas en hashtags.

- Si el usuario no tiene amigos ni ha otorgado Me Gusta:
  - Sugerencias de amistad basadas en popularidad.
  - Sugerencias de publicaciones basadas en popularidad.
 
Para mayor facilidad en la comprobación de que este sistema de recomendaciones funciona, se han creado una serie de usuarios ficticios.

Para la comprobación del algoritmo de hashtags, existen una serie de usuarios que tienen publicaciones subidas de un mismo tipo, por ejemplo, el usuario con el alias "usuario_playas_3" tiene tres publicaciones con el hashtag #playas, el usuario con el alias "usuario_flores_2" ha subido dos publicaciones con el hashtag #flores, podemos dar me gusta a cualquier de estas publicaciones y comprobar como en la página home se empiezan a recomendar publicaciones del mismo tipo.

Para la comprobación del algoritmo de amigos mutuos existe un usuario con el que podemos logearnos, estas son sus credenciales:

Email: admin@gmail.com
Contraseña: 1234

Este usuario ya tiene tres amigos aceptados, de manera que en la página Home se le realizarán sugencias de amistad basadas en amigos mutuos, estos usuarios tienen como alias "amigos_mutuos_3", "amigos_mutuos_2"... etc, el número indica la cantidad de amigos en común que tienen con el usuario en cuestión, deberían de salir ordenados por esa cantidad.

Para la comprobación del algoritmo basado en popularidad simplemente podemos crear un usuario nuevo.

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
