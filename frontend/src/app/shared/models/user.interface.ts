export interface User {
  id: number;
  alias: string;
  email: string;
  photoProfileUrl: string;
  friends: Friend[];
  posts: Post[];
  likesReceivedCount: number;
  friendSuggestions: Friend[];
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
  hashtags: string[];
  postLiked: boolean;
}

/*export interface Like {
  id: number;
  postId: number;
  userId: number;
}*/

export interface PostsResponse {
  posts: Post[];
  nextCursor: string;
}
