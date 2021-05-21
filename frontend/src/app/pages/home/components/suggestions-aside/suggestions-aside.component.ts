import { AfterViewInit, Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'suggestions-aside',
  templateUrl: 'suggestions-aside.component.html',
  styleUrls: ['suggestions-aside.component.scss'],
})
export class SuggestionsAsideComponent implements OnInit {
  public user$: Observable<User>;

  constructor(public readonly userService: UserService) {}

  ngOnInit() {
    this.user$ = this.userService.getUser();
  }
}
