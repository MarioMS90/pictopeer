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
export class UserService {
  constructor(private httpClient: HttpClient) {}

  getUser(): Observable<User> {
    return this.httpClient.get<User>(AppSettings.API_ENDPOINT_USER_ME);
  }

  getProfile(alias): Observable<UserProfile> {
    return this.httpClient.get<UserProfile>(
      `${AppSettings.API_ENDPOINT_USER_PROFILE}/${alias}`,
    );
  }

  getHomePosts(cursor: string): Observable<PostsResponse> {
    return this.httpClient.get<PostsResponse>(
      `${AppSettings.API_ENDPOINT_USER_POST}?nextCursor=${cursor}`,
    );
  }

  createLike(like: any): Observable<any> {
    return this.httpClient.post<any>(AppSettings.API_ENDPOINT_USER_LIKE, like);
  }

  deleteLike(postId: number): Observable<any> {
    return this.httpClient.delete<any>(
      `${AppSettings.API_ENDPOINT_USER_LIKE}/${postId}`,
    );
  }

  updateProfileImage(profileImage: any): Observable<ProfileImage> {
    return this.httpClient.post<ProfileImage>(
      AppSettings.API_ENDPOINT_USER_IMAGE,
      profileImage,
    );
  }

  createPost(post: any): Observable<Post> {
    return this.httpClient.post<Post>(AppSettings.API_ENDPOINT_USER_POST, post);
  }

  createFriendRequest(friendRequest: any): Observable<any> {
    return this.httpClient.post<any>(
      AppSettings.API_ENDPOINT_USER_FRIEND_REQUEST,
      friendRequest,
    );
  }

  updateFriendRequest(friendRequest: any): Observable<any> {
    return this.httpClient.put<any>(
      AppSettings.API_ENDPOINT_USER_FRIEND_REQUEST,
      friendRequest,
    );
  }

  searchUsersByAlias(value: any): Observable<ProfileSearch[]> {
    return this.httpClient.get<ProfileSearch[]>(
      `${AppSettings.API_ENDPOINT_USER_SEARCH}/${value}`,
    );
  }

  notifyLikesViewed(newLikesReceived: any): Observable<any> {
    return this.httpClient.put<any>(
      AppSettings.API_ENDPOINT_USER_NOTIFY_LIKES_VIEWED,
      newLikesReceived,
    );
  }
}
