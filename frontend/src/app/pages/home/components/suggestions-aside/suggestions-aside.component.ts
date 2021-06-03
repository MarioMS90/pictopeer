import { AfterViewInit, Component, Input, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { routes } from 'src/app/consts/routes';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-suggestions-aside',
  templateUrl: 'suggestions-aside.component.html',
  styleUrls: ['suggestions-aside.component.scss'],
})
export class SuggestionsAsideComponent {
  public user$: Observable<User>;
  public routes: typeof routes = routes;

  @Input() user: User;

  constructor() {}
}
