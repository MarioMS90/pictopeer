import {
  ActivatedRouteSnapshot,
  CanActivate,
  Router,
  RouterStateSnapshot,
} from '@angular/router';

import { AppSettings } from 'src/app/app.settings';
import { Injectable } from '@angular/core';
import { routes } from '../../consts/routes';

@Injectable({
  providedIn: 'root',
})
export class AuthGuard implements CanActivate {
  public routers: typeof routes = routes;

  constructor(private router: Router) {}

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot,
  ): boolean {
    const token = localStorage.getItem(AppSettings.APP_LOCALSTORAGE_TOKEN);

    if (token) {
      return true;
    } else {
      this.router.navigate([this.routers.LOGIN]);
    }
  }
}
