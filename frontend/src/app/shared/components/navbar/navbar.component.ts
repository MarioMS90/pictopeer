import { AfterViewInit, Component } from '@angular/core';
import { Router } from '@angular/router';
import { routes } from 'src/app/consts/routes';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: 'navbar.component.html',
  styleUrls: ['navbar.component.scss'],
})
export class NavbarComponent {
  public routes: typeof routes = routes;

  constructor(
    private readonly service: AuthService,
    private readonly router: Router,
  ) {}

  public logout(): void {
    this.service.logout().subscribe(
      () => {
        return this.router.navigate([this.routes.LOGIN]);
      },
      ({ error }) => {
        throw new Error(error.message);
      },
    );
  }
}
