import { Observable, Subject } from 'rxjs';
import { AppSettings } from 'src/app/app.settings';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import {
  Post,
  PostsResponse,
  ProfileImage,
  ProfileSearch,
  User,
  UserProfile,
} from '../models/user.interface';

@Injectable({
  providedIn: 'root',
})
export class PostService {
  constructor(private httpClient: HttpClient) {}

  getHomePosts(cursor: string): Observable<PostsResponse> {
    return this.httpClient.get<PostsResponse>(
      `${AppSettings.API_ENDPOINT_POST}?nextCursor=${cursor}`,
    );
  }

  createPost(post: any): Observable<Post> {
    return this.httpClient.post<Post>(AppSettings.API_ENDPOINT_POST, post);
  }

  createLike(like: any): Observable<any> {
    return this.httpClient.post<any>(AppSettings.API_ENDPOINT_POST_LIKE, like);
  }

  deleteLike(postId: number): Observable<any> {
    return this.httpClient.delete<any>(
      `${AppSettings.API_ENDPOINT_POST_LIKE}/${postId}`,
    );
  }
}
