import { environment } from 'src/environments/environment';

export class AppSettings {
  public static readonly API_ENDPOINT = environment.APIENDPOINT_BACKEND;
  public static readonly APP_LOCALSTORAGE_TOKEN = 'JWT_Token';
  public static readonly API_ENDPOINT_LOGIN =
    AppSettings.API_ENDPOINT + 'auth/local/';
  public static readonly API_ENDPOINT_REGISTER =
    AppSettings.API_ENDPOINT + 'register/local/';
  public static readonly API_ENDPOINT_LOGOUT =
    AppSettings.API_ENDPOINT + 'logout/local/';
  public static readonly API_ENDPOINT_USER =
    AppSettings.API_ENDPOINT + 'user/me';
  public static readonly API_ENDPOINT_USER_POSTS =
    AppSettings.API_ENDPOINT + 'user/posts';
  public static readonly API_ENDPOINT_USER_LIKE =
    AppSettings.API_ENDPOINT + 'user/like';
  public static readonly API_ENDPOINT_USER_FRIEND_REQUEST =
    AppSettings.API_ENDPOINT + 'user/friend-request';
  public static readonly API_ENDPOINT_USER_NOTIFY_LIKES_VIEWED =
    AppSettings.API_ENDPOINT + 'user/notify-likes-viewed';
  public static readonly API_ENDPOINT_USER_SEARCH =
    AppSettings.API_ENDPOINT + 'user/search';
  public static readonly API_ENDPOINT_USER_PROFILE_IMAGE =
    AppSettings.API_ENDPOINT + 'user/image';
  public static readonly API_ENDPOINT_USER_POST =
    AppSettings.API_ENDPOINT + 'user/post';
}
