export interface UserResponse {
  user: User;
}

export interface User {
  id: number;
  alias: string;
  email: string;
  photoProfileUrl: string;
  friends: Friend[];
  posts: Post[];
  friendSuggestions: Friend[];
  likesReceived: number;
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
  userId: number;
  date: string;
  photoUrl: string;
  alias: string;
  likeCount: number;
}
