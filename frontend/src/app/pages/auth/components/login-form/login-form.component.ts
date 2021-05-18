import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { routes } from 'src/app/consts/routes';
import { AuthService } from '../../../../shared/services/auth.service';

@Component({
  selector: 'app-login-form',
  templateUrl: './login-form.component.html',
  styleUrls: ['../../styles/form-styles.scss'],
})
export class LoginFormComponent implements OnInit {
  public routes: typeof routes = routes;
  public form: FormGroup;
  public errorMessage: String;

  constructor(
    private readonly authService: AuthService,
    private readonly router: Router,
  ) {}

  public ngOnInit(): void {
    this.form = new FormGroup({
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', [Validators.required]),
    });
  }

  public login(): void {
    if (this.form.valid) {
      this.authService.login({ ...this.form.value }).subscribe(
        () => {
          return this.router.navigate([this.routes.HOME]);
        },
        ({ error }) => {
          this.errorMessage = error.message;
        },
      );
    }
  }
}
