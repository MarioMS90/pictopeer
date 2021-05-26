import { Component, EventEmitter, Input, Output } from '@angular/core';
import { FriendRequest } from 'src/app/shared/models/friend-request.enum';
import { Notification } from 'src/app/shared/models/user.interface';

@Component({
  selector: 'app-notification-friend-request',
  templateUrl: 'notification-friend-request.html',
  styleUrls: ['notification-friend-request.scss'],
})
export class NotificationFriendRequest {
  @Input() friendRequest: Notification;
  @Output() onUpdateFriendRequest: EventEmitter<any> = new EventEmitter();

  acceptFriendRequest = friendRequest =>
    this.onUpdateFriendRequest.emit({
      id: friendRequest.id,
      status: FriendRequest.ACCEPTED,
    });

  rejectFriendRequest = friendRequest =>
    this.onUpdateFriendRequest.emit({
      id: friendRequest.id,
      status: FriendRequest.REJECTED,
    });
}
