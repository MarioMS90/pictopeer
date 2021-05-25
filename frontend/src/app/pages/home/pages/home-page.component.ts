import { Component, OnInit } from '@angular/core';
import { images } from 'src/app/consts/images';
import { Post, User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: `app-home-page`,
  templateUrl: 'home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
})
export class HomePageComponent implements OnInit {
  public user: User;
  public images: typeof images = images;
  private cursor: string = null;
  public posts: Post[] = [];

  constructor(public readonly userService: UserService) { }

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });

    this.getPosts();
  }

  getPosts() {
    this.userService.getPosts(this.cursor).subscribe(postsResponse => {
      this.posts = this.posts.concat(postsResponse.posts);
      if (this.cursor != postsResponse.nextCursor) {
        this.cursor = postsResponse.nextCursor;
      } else {
        this.cursor = null;
      }
    });
  }

  onScroll() {
    if (this.cursor) {
      this.getPosts();
    }
  }

  sendLike(postId) {
    this.userService
      .createLike({ postId: postId, userId: this.user.id })
      .subscribe(() => {
        const post = this.posts.find(post => post.id === postId);
        post.postLiked = !post.postLiked;
        post.likeCount = post.likeCount + 1;
      });
  }

  sendDislike(postId) {
    this.userService.deleteLike(postId).subscribe(() => {
      const post = this.posts.find(post => post.id === postId);
      post.postLiked = !post.postLiked;
      post.likeCount = post.likeCount - 1;
    });
  }
}
