import { Observable, of } from 'rxjs';
import { shareReplay, tap } from 'rxjs/operators';

import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { TokenResponse } from '../../shared/models/token-response.interface';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  constructor(private httpClient: HttpClient) {}

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
}
