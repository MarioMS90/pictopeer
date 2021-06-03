import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { routes } from 'src/app/consts/routes';
import { Post, User } from 'src/app/shared/models/user.interface';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-post-card',
  templateUrl: 'post-card.component.html',
  styleUrls: ['post-card.component.scss'],
})
export class PostCardComponent {
  public routes: typeof routes = routes;

  @Input() post: Post;
  @Input() isProfileCard: boolean = false;
  @Output() onCreateLike: EventEmitter<any> = new EventEmitter();
  @Output() onDeleteLike: EventEmitter<any> = new EventEmitter();

  constructor(private readonly userService: UserService) {}

  sendLike() {
    if (this.post.postLiked === true) {
      this.dislike();
    } else {
      this.like();
    }
  }

  like() {
    this.userService.createLike({ postId: this.post.id }).subscribe(() => {
      this.post.postLiked = !this.post.postLiked;
      this.post.likeCount = this.post.likeCount + 1;
      this.onCreateLike.emit();
    });
  }

  dislike() {
    this.userService.deleteLike(this.post.id).subscribe(() => {
      this.post.postLiked = !this.post.postLiked;
      this.post.likeCount = this.post.likeCount - 1;
      this.onDeleteLike.emit();
    });
  }
}
