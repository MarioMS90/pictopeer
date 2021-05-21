import { Observable, Subject } from 'rxjs';
import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { PostsResponse, User } from '../models/user.interface';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  user$: Observable<User>;

  constructor(private httpClient: HttpClient) {}

  getUser(): Observable<User> {
    if (!this.user$) {
      this.user$ = this.httpClient.get<User>(AppSettings.API_ENDPOINT_USER);
    }

    return this.user$;
  }

  getPosts(cursor: string): Observable<PostsResponse> {
    return this.httpClient.get<PostsResponse>(
      `${AppSettings.API_ENDPOINT_USER_POSTS}?nextCursor=${cursor}`,
    );
  }

  updateLike(postId: number): Observable<any> {
    return this.httpClient.put<any>(AppSettings.API_ENDPOINT_USER_LIKE, {
      postId: postId,
    });
  }
}
