import { AfterViewInit, OnInit } from '@angular/core';
import { Component, ViewEncapsulation } from '@angular/core';
import { Post, User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: `app-home-page`,
  templateUrl: 'home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class HomePageComponent implements OnInit {
  public user: User;
  private cursor: string = null;
  public posts: Post[] = [];

  constructor(public readonly userService: UserService) {}

  ngOnInit() {
    this.userService.getUser();
    this.getPosts();
  }

  getPosts() {
    this.userService.getPosts(this.cursor).subscribe(posts => {
      this.posts = this.posts.concat(posts.data);
      this.cursor = posts.nextCursor;
      console.log(this.posts);
    });
  }

  onScroll() {
    this.getPosts();
  }

  sendLike(like) {}
}
