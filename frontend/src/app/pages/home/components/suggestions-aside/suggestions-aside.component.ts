import { AfterViewInit, Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { routes } from 'src/app/consts/routes';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-suggestions-aside',
  templateUrl: 'suggestions-aside.component.html',
  styleUrls: ['suggestions-aside.component.scss'],
})
export class SuggestionsAsideComponent implements OnInit {
  public user: User;
  public routes: typeof routes = routes;

  constructor(public readonly userService: UserService) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }
}
