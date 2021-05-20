import { Observable, Subject } from 'rxjs';
import { shareReplay, tap } from 'rxjs/operators';
import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { User } from '../models/user.interface';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  user$: Observable<User>;

  constructor(private httpClient: HttpClient) { }

  setUser(): void {
    this.user$ = this.httpClient
      .get<User>(AppSettings.API_ENDPOINT_USER);
  }

  getPosts(cursor: string) {
    return this.httpClient.get(`${AppSettings.API_ENDPOINT_USER_POSTS}?nextCursor=${cursor}`)
  }
}
