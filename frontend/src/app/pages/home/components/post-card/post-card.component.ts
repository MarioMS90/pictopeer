import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Post } from 'src/app/shared/models/user.interface';

@Component({
  selector: 'post-card',
  templateUrl: 'post-card.component.html',
  styleUrls: ['post-card.component.scss'],
})
export class PostCardComponent {
  @Input() post: Post;
  @Output() onLike: EventEmitter<any> = new EventEmitter();

  like() {
    this.onLike.emit(this.post.id);
  }
}
