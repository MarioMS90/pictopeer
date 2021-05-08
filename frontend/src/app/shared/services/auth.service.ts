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
    email: string;
    password: string;
  }): Observable<any> {

    return this.httpClient.post<any>(AppSettings.API_ENDPOINT_AUTH, {...credentials});
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
