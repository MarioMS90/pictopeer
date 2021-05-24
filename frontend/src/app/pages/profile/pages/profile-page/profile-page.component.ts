import { Component, OnInit } from '@angular/core';
import { images } from 'src/app/consts/images';
import { Post, User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-profile-page',
  templateUrl: './profile-page.component.html',
  styleUrls: ['./profile-page.component.scss'],
})
export class ProfilePageComponent implements OnInit {
  public user: User;
  public images: typeof images = images;
  private cursor: string = null;
  public posts: Post[] = [];

  constructor(public readonly userService: UserService) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }
}
