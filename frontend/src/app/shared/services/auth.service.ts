import { Observable } from 'rxjs';
import { shareReplay, tap } from 'rxjs/operators';
import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { TokenResponse } from '../models/token-response.interface';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  constructor(
    private httpClient: HttpClient,
    private readonly userService: UserService,
  ) { }

  login(credentials: {
    email: string;
    password: string;
  }): Observable<TokenResponse> {
    return this.httpClient
      .post<TokenResponse>(AppSettings.API_ENDPOINT_LOGIN, credentials)
      .pipe(
        tap(({ token }) =>
          localStorage.setItem(AppSettings.APP_LOCALSTORAGE_TOKEN, token),
        ),
        shareReplay(),
      );
  }

  register(credentials: {
    email: string;
    password: string;
    alias: string;
  }): Observable<TokenResponse> {
    return this.httpClient
      .post<TokenResponse>(AppSettings.API_ENDPOINT_REGISTER, credentials)
      .pipe(
        tap(({ token }) =>
          localStorage.setItem(AppSettings.APP_LOCALSTORAGE_TOKEN, token),
        ),
        shareReplay(),
      );
  }

  logout(): Observable<any> {
    const token = localStorage.getItem(AppSettings.APP_LOCALSTORAGE_TOKEN);

    return this.httpClient
      .post<any>(AppSettings.API_ENDPOINT_LOGOUT, { token: token })
      .pipe(
        tap(() => {
          localStorage.removeItem(AppSettings.APP_LOCALSTORAGE_TOKEN);
          this.userService.user$ = null;
        }),
        shareReplay(),
      );
  }
}
