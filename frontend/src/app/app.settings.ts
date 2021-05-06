import { environment } from 'src/environments/environment';

export class AppSettings {
  public static readonly APP_NAME = 'FAK';
  public static readonly APP_LOCALSTORAGE_TOKEN = 'FAK_Token';
  public static readonly APP_VERSION = '0.1.0';
  public static readonly API_ENDPOINT = environment.APIENDPOINT_BACKEND;
  public static readonly STATIC_ENDPOINT = AppSettings.API_ENDPOINT + 'static/';

  public static readonly API_ENDPOINT_APP = AppSettings.API_ENDPOINT + 'app/';
  public static readonly API_ENDPOINT_USER = AppSettings.API_ENDPOINT + 'user';

  public static readonly API_ENDPOINT_AUTH = AppSettings.API_ENDPOINT + 'auth/';
  public static readonly API_ENDPOINT_AUTH_LOCAL =
    AppSettings.API_ENDPOINT + 'auth/local/';

  public static readonly APP_DEFAULT_MOMENT_LOCALE = 'es';
  public static readonly GUESS_ROL = {
    value: 'guess',
    text: 'settings.rol.GUESS'
  };
  public static readonly STUDENT_ROL = {
    value: 'student',
    text: 'settings.rol.STUDENT'
  };
  public static readonly ADMINISTRATOR_ROL = {
    value: 'admin',
    text: 'settings.rol.ADMINISTRATOR'
  };
  public static readonly COMPANY_ROL = {
    value: 'company',
    text: 'settings.rol.COMPANY'
  };
  public static readonly ROLES = [
    AppSettings.GUESS_ROL,
    AppSettings.STUDENT_ROL,
    AppSettings.COMPANY_ROL,
    AppSettings.ADMINISTRATOR_ROL
  ];

  public static readonly USER_STATUS_PENDING = {
    value: 'pending',
    text: 'settings.status.PENDING'
  };
  public static readonly USER_STATUS_ACTIVE = {
    value: 'active',
    text: 'settings.status.ACTIVE'
  };
  public static readonly USER_STATUS_INACTIVE = {
    value: 'inactive',
    text: 'settings.status.INACTIVE'
  };
  public static readonly USER_STATUS = [
    AppSettings.USER_STATUS_PENDING,
    AppSettings.USER_STATUS_ACTIVE,
    AppSettings.USER_STATUS_INACTIVE
  ];

  public static readonly DEFAULT_FORMAT_DATE = 'MM/DD/YYYY';

  public static readonly IMAGES = {
    UNKNOWN_IMAGE: 'assets/images/image-not-found.png',
    UNKNOWN_FACE: 'assets/images/face-unknown.png',
    UNKNOWN_TEAM: 'assets/images/image-not-found.png'
  };


  public static readonly FORMAT_DATE = 'MM/DD/YYYY';

  public static readonly NOTIFICATIONS = {
    DEFAULT_TIME: 2000
  };
}