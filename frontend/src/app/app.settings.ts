import { environment } from 'src/environments/environment';

export class AppSettings {
  public static readonly API_ENDPOINT = environment.APIENDPOINT_BACKEND;
  public static readonly APP_LOCALSTORAGE_TOKEN = 'FAK_Token';
  public static readonly API_ENDPOINT_AUTH = AppSettings.API_ENDPOINT + 'login/';
}