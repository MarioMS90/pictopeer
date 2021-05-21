import { AfterViewInit, OnInit } from '@angular/core';
import { Component, ViewEncapsulation } from '@angular/core';
import { Observable } from 'rxjs';
import { Post, User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: `app-home-page`,
  templateUrl: 'home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class HomePageComponent implements OnInit {
  public user$: Observable<User>;
  private cursor: string = null;
  public posts: Post[] = [];

  constructor(public readonly userService: UserService) {}

  ngOnInit() {
    this.user$ = this.userService.getUser();
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
    this.userService.updateLike(postId).subscribe(() => {
      const post = this.posts.find(post => post.id === postId);
      post.postLiked = !post.postLiked;
      post.likeCount = post.postLiked ? post.likeCount + 1 : post.likeCount - 1;
    });
  }
}
