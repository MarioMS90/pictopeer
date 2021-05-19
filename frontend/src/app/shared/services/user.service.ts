import { Observable, Subject } from 'rxjs';
import { shareReplay, tap } from 'rxjs/operators';
import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { User, UserResponse } from '../models/user.interface';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  //user: Subject<User> = new Subject<User>();
  user: 

  constructor(private httpClient: HttpClient) {}

  setUser(): Observable<UserResponse> {
    return this.httpClient
      .get<UserResponse>(AppSettings.API_ENDPOINT_USER)
      .pipe(
        tap(({ user }) => this.user.next(user)),
        shareReplay(),
      );
  }
}
