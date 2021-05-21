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
}
