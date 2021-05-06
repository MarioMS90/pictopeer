import { AuthService } from 'src/app/shared/services/auth.service';
import { Component } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';
import { routes } from '../../../consts';

@Component({
  selector: 'app-auth-page',
  templateUrl: './auth-page.component.html',
  styleUrls: ['./auth-page.component.scss']
})
export class AuthPageComponent {
  public todayDate: Date = new Date();
  public routers: typeof routes = routes;

  constructor(
    private readonly service: AuthService,
    private readonly router: Router,
    private readonly snackBarService: MatSnackBar,
  ) { }

  public sendLoginForm(credentials): void {
    this.service.login(credentials).subscribe(
      ({ token }) => {
        return this.router.navigate([this.routers.ACTIVITY]); 
      },
      (error) => {
        this.showSnackBar({
          message: 'Error en el usuario o password. Póngase en contacto con el administrador',
          title: 'ERROR',
        });
      }
    ); 
  }
  showSnackBar({ message, title }) {
    this.snackBarService.open(message, title, {
      duration: 4000,
    });
  }

/*   public sendSignForm(): void {
    this.service.sign();

    this.router.navigate([this.routers.DASHBOARD]).then();
  } */
}
