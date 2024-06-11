<p align="center">
  <img src="https://i.imgur.com/BTF46wP.png" width="240" alt="Pictopeer Logo" />
</p>

[travis-image]: https://api.travis-ci.org/nestjs/nest.svg?branch=master
[travis-url]: https://travis-ci.org/nestjs/nest
[linux-image]: https://img.shields.io/travis/nestjs/nest/master.svg?label=linux
[linux-url]: https://travis-ci.org/nestjs/nest

<p align="center">A social media platform for posting and sharing images built with Angular and Laravel.</p>
<p align="center">
<img src="https://img.shields.io/badge/Laravel-v6.20-orange" alt="Laravel Version" />
<img src="https://img.shields.io/badge/Angular-v9.1.12-red" alt="Angular Version" />
<img src="https://img.shields.io/badge/Bootstrap-v4.5.0-blue" alt="Bootstrap Version" />
<img src="https://img.shields.io/badge/MySQL-v5.7.22-lightgrey" alt="MySQL Version" />
<img src="https://img.shields.io/npm/l/@nestjs/core.svg" alt="App License" />
</p>

## Description

A social network where users can post images with tags or hashtags, add friends, search for users, visit profiles, and like posts."

## Architecture
The backend is built with Laravel, where models act as their own service. There are 4 controllers:
- AuthController: Contains endpoints for login and registration.
- UserController: Handles endpoints related to user functionalities.
- PostController: Manages endpoints related to posts.
- ImageController: Responsible for uploading images for both posts and profile pictures using the Imgur API.

The frontend is developed using Angular and divided into 3 modules: authentication module, home page, and profile page. Additionally, three services are implemented:
- AuthService: Handles authentication operations.
- UserService: Manages user-related operations.
- PostService: Manages post-related operations.

## Página de login
<p align="center">
  <img src="https://i.imgur.com/OxPqwBf.png" width="340" alt="Pictopeer Login" />
</p>

Upon entering the website, the first requirement is either logging in or registering. This authentication process utilizes an authorization token (JWT). Once the user inputs their credentials, they are sent to the backend via a POST request. If the data is correct, the frontend receives a unique token as a response, which identifies the user and is stored in a local database (localStorage). From then on, all user actions on the website requiring backend requests must include this token as a signature in the header. To achieve this, an interceptor in Angular is employed, responsible for adding the token to the headers of each outgoing request from the frontend. On the backend side, I utilized a library called jwt-auth, which handles the generation and validation of authorization tokens.

## Página de perfil
<p align="center">
  <img src="https://i.imgur.com/OOZ9dFv.png" width="640" alt="Pictopeer Profile" />
</p>

On the profile page, users can view a summary of their statistics, including the number of friends, posts, and likes received. Additionally, all user posts are displayed. If viewing one's own profile, users can change their profile picture by clicking on the image.

When viewing another user's profile, a button to send a friend request will appear.

## Barra de navegación
<p align="center">
  <img src="https://i.imgur.com/x6DMMNs.png" width="640" alt="Pictopeer Navbar" />
</p>

The navigation bar, present on all pages, facilitates browsing throughout the website. It includes a user search bar with autocomplete functionality implemented using the Ngx-Angular-Autocomplete library. Upon searching for any user, users will be directed to their profile.

Furthermore, users can view notifications, which come in two types: friend requests (which can be accepted or rejected directly from there) and new likes received. The latter type of notification is displayed only the first time until the user views it.
<p align="center">
  <img src="https://i.imgur.com/Xy6znWy.png" width="240" alt="Pictopeer Notifications" />
</p>

## Amigos
<p align="center">
  <img src="https://i.imgur.com/a5jSyMp.png" width="640" alt="Pictopeer Friends" />
</p>

From this page, users can view their list of friends and have the option to remove them.

## Publicar
<p align="center">
  <img src="https://i.imgur.com/YZJlNct.png" width="640" alt="Pictopeer Publish" />
</p>

Here, users can make new posts, preview the image, and add the hashtags they want.

## Home
<p align="center">
  <img src="https://i.imgur.com/mp3kBEo.png" width="640" alt="Pictopeer Publish" />
</p>
On the homepage of the website, users will receive friend suggestions and a personalized list of posts. This list is generated by combining the user's friends' posts with recommended posts and sorting them by descending date, creating an engaging feed similar to what is seen on other social media platforms like Facebook or Instagram.

The list is displayed using infinite scroll, facilitated by the Ngx-infinite-scroll library. This library detects user scrolling and sends requests to the backend when necessary. On the backend, I used a Laravel pagination library based on cursors. It calculates the next cursor for the post query and includes it in the response to the frontend. This ensures that the backend knows the last post it queried for in subsequent requests.

Friend and post suggestions/recommendations are based on various criteria determined by the user's activity on the website. These algorithms change dynamically at runtime, and only one is used at a time, making it suitable for the Strategy pattern.

The Strategy pattern is a behavioral pattern that maintains a set of algorithms from which the client object can choose the one that suits it best and interchange it dynamically according to its needs.

There are three types of recommendation algorithms on the backend:

- Mutual Friends Based:
 - Provides friend suggestions from users who share mutual friends. The more mutual friends a user has with another user, the higher priority they are given as a friend suggestion.
 - Recommends posts from these same users.
- Hashtag Based:
 - Suggests friends who post content with hashtags that the user frequently engages with. For instance, if a user tends to like posts with the hashtag #beach, they will be recommended users who frequently post with that hashtag.
 - Recommends posts from these same users.
- Popularity Based:
 - Offers friend suggestions based on users with the most friends.
 - Recommends posts with the highest number of likes received.


These algorithms are selected by the clients (PostController and UserController) based on a series of criteria. Each of these controllers has a switch function (getPostSuggesterByUserState and getFriendSuggesterByUserState) that checks the user's state and returns an instance of one of these types of algorithms using a factory pattern (SuggesterFactory). The criteria are:

- If the user has friends:
- Friend suggestions based on mutual friends.
 - Post suggestions based on mutual friends, but only if the user hasn't liked any posts.

- If the user has liked a post:
   - Friend suggestions based on hashtags, but only if the user has no friends.
   - Post suggestions based on hashtags.
   
- If the user has no friends and hasn't liked any posts:
 - Friend suggestions based on popularity.
 - Post suggestions based on popularity.

## Contact

Author - [Mario Muñoz Serrano](https://github.com/MarioMS90)

## License

"Pictopeer" is licensed under the [MIT License](LICENSE).
