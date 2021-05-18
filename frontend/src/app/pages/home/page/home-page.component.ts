import { AfterViewInit } from '@angular/core';
import { Component, ViewEncapsulation } from '@angular/core';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: `app-home-page`,
  templateUrl: 'home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class HomePageComponent implements AfterViewInit {
  constructor(private readonly userService: UserService) {}

  ngAfterViewInit() {
    this.userService.getUser().subscribe(user => {
      console.log(user);
    });
  }
}
