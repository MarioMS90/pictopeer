import { Observable, of } from 'rxjs';
import { shareReplay, tap } from 'rxjs/operators';

import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { TokenResponse } from '../models/token-response.interface';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(
    private httpClient: HttpClient,
  ) { }

  

  login(credentials: {
    emailOrUid: string;
    password: string;
  }): Observable<TokenResponse> {

    return this.httpClient.post<TokenResponse>(AppSettings.API_ENDPOINT_AUTH_LOCAL, credentials).pipe(
      tap(({ token }) => localStorage.setItem(AppSettings.APP_LOCALSTORAGE_TOKEN, token)),
      shareReplay(),
    );
  }

 /*  public login(): void {
    
    localStorage.setItem('token', 'token');
  } */

/*   public sign(): void {
    localStorage.setItem('token', 'token');
  }

  public signOut(): void {
    localStorage.removeItem('token');
  } */

  /* public getUser(): Observable<User> {
    return of({
      name: 'John',
      lastName: 'Smith'
    });
  } */
}
