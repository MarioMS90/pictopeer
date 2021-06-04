import { Component, OnInit, ViewChild } from '@angular/core';
import { FileSystemFileEntry, NgxFileDropEntry } from 'ngx-file-drop';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-friends-page',
  templateUrl: 'friends-page.component.html',
  styleUrls: ['friends-page.component.scss'],
})
export class FriendsPageComponent implements OnInit {
  public user: User;

  constructor(private readonly userService: UserService) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }

  deleteFriend(friendId) {
    this.userService.deleteFriend(friendId).subscribe(as => {
      console.log(as);
      this.user.friends = this.user.friends.filter(({ id }) => id !== friendId);
    });
  }
}
