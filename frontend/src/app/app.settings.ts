import { environment } from 'src/environments/environment';

export class AppSettings {
  public static readonly API_ENDPOINT = environment.APIENDPOINT_BACKEND;
  public static readonly APP_LOCALSTORAGE_TOKEN = 'JWT_Token';
  public static readonly API_ENDPOINT_LOGIN =
    AppSettings.API_ENDPOINT + 'login/';
  public static readonly API_ENDPOINT_REGISTER =
    AppSettings.API_ENDPOINT + 'register/';
}
