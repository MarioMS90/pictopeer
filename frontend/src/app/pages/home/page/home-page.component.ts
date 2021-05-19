import { AfterViewInit } from '@angular/core';
import { Component, ViewEncapsulation } from '@angular/core';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: `app-home-page`,
  templateUrl: 'home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class HomePageComponent implements AfterViewInit {
  public user: User;

  constructor(public readonly userService: UserService) {}

  ngAfterViewInit() {
    this.userService.setUser().subscribe(({ user }) => {
      this.user = user;
      console.log(this.user);
    });
  }
}
