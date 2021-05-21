import { AfterViewInit, Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';
import { routes } from 'src/app/consts/routes';
import { User } from '../../models/user.interface';
import { AuthService } from '../../services/auth.service';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-navbar',
  templateUrl: 'navbar.component.html',
  styleUrls: ['navbar.component.scss'],
})
export class NavbarComponent implements OnInit {
  public user$: Observable<User>;
  public routes: typeof routes = routes;

  constructor(
    private readonly service: AuthService,
    private readonly userService: UserService,
    private readonly router: Router,
  ) {}

  ngOnInit() {
    this.user$ = this.userService.getUser();
  }

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
