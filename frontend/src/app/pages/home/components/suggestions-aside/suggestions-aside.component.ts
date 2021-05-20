import { AfterViewInit, Component } from '@angular/core';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'suggestions-aside',
  templateUrl: 'suggestions-aside.component.html',
  styleUrls: ['suggestions-aside.component.scss'],
})
export class SuggestionsAsideComponent {
  constructor(public readonly userService: UserService) {}
}
