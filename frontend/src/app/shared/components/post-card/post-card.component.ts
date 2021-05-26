import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { routes } from 'src/app/consts/routes';
import { Post, User } from 'src/app/shared/models/user.interface';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-post-card',
  templateUrl: 'post-card.component.html',
  styleUrls: ['post-card.component.scss'],
})
export class PostCardComponent implements OnInit {
  public routes: typeof routes = routes;
  private user: User;

  @Input() post: Post;
  @Input() isProfileCard: boolean = false;

  constructor(private readonly userService: UserService) {}

  sendLike() {
    if (this.post.postLiked === true) {
      this.dislike();
    } else {
      this.like();
    }
  }

  like() {
    this.userService
      .createLike({ postId: this.post.id, userId: this.user.id })
      .subscribe(() => {
        this.post.postLiked = !this.post.postLiked;
        this.post.likeCount = this.post.likeCount + 1;
      });
  }

  dislike() {
    this.userService.deleteLike(this.post.id).subscribe(() => {
      this.post.postLiked = !this.post.postLiked;
      this.post.likeCount = this.post.likeCount - 1;
    });
  }

  ngOnInit(): void {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }
}
