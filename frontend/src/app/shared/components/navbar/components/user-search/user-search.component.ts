import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Router } from '@angular/router';
import { routes } from 'src/app/consts/routes';
import { ProfileSearch } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-user-search',
  templateUrl: 'user-search.component.html',
  styleUrls: ['user-search.component.scss'],
})
export class UserSearchComponent {
  public keyword: string = 'alias';
  public profilesFound: ProfileSearch[];
  public routes: typeof routes = routes;

  constructor(
    private readonly userService: UserService,
    private readonly router: Router,
  ) {}

  selectEvent(profile) {
    return this.router.navigate([`${this.routes.PROFILE}/${profile.alias}`]);
  }

  onChangeSearch(value) {
    if (value) {
      this.userService.searchUsersByAlias(value).subscribe(profilesFound => {
        this.profilesFound = profilesFound;
      });
    }
  }

  goToProfile() {
    if (this.profilesFound) {
      return this.router.navigate([
        `${this.routes.PROFILE}/${this.profilesFound[0].alias}`,
      ]);
    }
  }
}
