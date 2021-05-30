export interface User {
  id: number;
  alias: string;
  email: string;
  photoProfileUrl: string;
  friendSuggestions: Friend[];
  friendRequests: Notification[];
  newLikesReceived: Notification[];
  newUser: boolean;
}

export interface UserProfile {
  id: number;
  alias: string;
  photoProfileUrl: string;
  posts: Post[];
  likesReceivedCount: number;
  friendsCount: number;
  friendStatus: number;
}

export interface Friend {
  id: number;
  alias: string;
  email: string;
  photoProfileUrl: string;
}

export interface Post {
  id: number;
  photoProfileUrl: string;
  date: string;
  photoUrl: string;
  alias: string;
  likeCount: number;
  hashtags: Hashtag[];
  postLiked: boolean;
}

export interface Hashtag {
  name: string;
}

export interface Notification {
  id: number;
  alias: string;
}

export interface ProfileImage {
  photoUrl: string;
}

export interface ProfileSearch {
  photoProfileUrl: string;
  alias: string;
}

export interface PostsResponse {
  posts: Post[];
  nextCursor: string;
}
