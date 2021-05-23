import { Component, EventEmitter, Input, Output } from '@angular/core';
import { routes } from 'src/app/consts/routes';
import { Post } from 'src/app/shared/models/user.interface';

@Component({
  selector: 'post-card',
  templateUrl: 'post-card.component.html',
  styleUrls: ['post-card.component.scss'],
})
export class PostCardComponent {
  public routes: typeof routes = routes;

  @Input() post: Post;
  @Output() onLike: EventEmitter<any> = new EventEmitter();
  @Output() onDislike: EventEmitter<any> = new EventEmitter();

  sendLike() {
    if (this.post.postLiked === true) {
      this.onDislike.emit(this.post.id);
    } else {
      this.onLike.emit(this.post.id);
    }
  }

  dislike() {}
}
