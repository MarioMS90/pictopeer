import { AfterViewInit, Component } from '@angular/core';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'suggestions-aside',
  templateUrl: 'suggestions-aside.component.html',
  styleUrls: ['suggestions-aside.component.scss'],
})
export class SuggestionsAsideComponent implements AfterViewInit {
  public user: User;

  constructor(public readonly userService: UserService) {}

  ngAfterViewInit(): void {
    this.userService.user.subscribe(user => {
      this.user = user;
      console.log(this.user);
    });
  }
}
