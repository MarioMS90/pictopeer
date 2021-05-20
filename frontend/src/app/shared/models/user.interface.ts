export interface User {
  id: number;
  alias: string;
  email: string;
  photoProfileUrl: string;
  friends: Friend[];
  posts: Post[];
  friendSuggestions: Friend[];
  likesReceivedCount: number;
  likesGiven: Like[];
  newUser: boolean;
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
}

export interface Like {
  id: number;
  postId: number;
  userId: number;
}

export interface PostsResponse {
  data: Post[];
  nextCursor: string;
}
