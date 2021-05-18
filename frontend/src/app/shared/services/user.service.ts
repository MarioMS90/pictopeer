import { Observable } from 'rxjs';
import { shareReplay, tap } from 'rxjs/operators';
import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { TokenResponse } from '../models/token-response.interface';
import { User } from '../models/user.interface';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  private user: User;

  constructor(private httpClient: HttpClient) {}

  getUser(): Observable<User> {
    return this.httpClient.get<User>(AppSettings.API_ENDPOINT_USER_ME).pipe(
      tap(user => (this.user = user)),
      shareReplay(),
    );
  }
}
