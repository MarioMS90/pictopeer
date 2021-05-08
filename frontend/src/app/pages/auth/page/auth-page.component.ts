import { AuthService } from 'src/app/shared/services/auth.service';
import { AfterViewInit, Component, ElementRef } from '@angular/core';
import { Router } from '@angular/router';
import { routes } from '../../../consts';

@Component({
  selector: 'app-auth-page',
  templateUrl: './auth-page.component.html',
  styleUrls: ['./auth-page.component.scss'],
})
export class AuthPageComponent implements AfterViewInit {
  public todayDate: Date = new Date();
  public routers: typeof routes = routes;

  constructor(
    private readonly service: AuthService,
    private readonly router: Router,
    private elementRef: ElementRef,
  ) {}

  public sendLoginForm(credentials): void {
    this.service.login(credentials).subscribe(
      (token) => {
        console.log(token)
      },
      error => {
        console.log(error);
      },
    );
  }

  ngAfterViewInit(): void {
    this.elementRef.nativeElement.ownerDocument.body.style.background =
      'linear-gradient(to right, #3bc6f4, #f2fcfe)';
  }
}
