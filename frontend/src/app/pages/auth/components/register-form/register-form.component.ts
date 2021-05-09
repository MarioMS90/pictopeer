import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { routes } from 'src/app/consts/routes';
import { AuthService } from '../../auth.service';

@Component({
  selector: 'app-sign-form',
  templateUrl: './register-form.component.html',
  styleUrls: ['../../styles/form-styles.scss'],
})
export class RegisterFormComponent implements OnInit {
  public routes: typeof routes = routes;
  public form: FormGroup;
  public errorMessages: Array<String>;

  constructor(
    private readonly service: AuthService,
    private readonly router: Router,
  ) {}

  public ngOnInit(): void {
    this.form = new FormGroup({
      alias: new FormControl('', [
        Validators.required,
        Validators.maxLength(35),
      ]),
      email: new FormControl('', [
        /*Validators.required,
        Validators.email,
        Validators.maxLength(60),*/
      ]),
      password: new FormControl('', [
        Validators.required,
        Validators.minLength(8),
      ]),
      password_confirmation: new FormControl('', [
        Validators.required,
        Validators.minLength(8),
      ]),
    });
  }

  public register(): void {
    if (this.form.valid) {
      this.service.register({ ...this.form.value }).subscribe(
        () => {
          return this.router.navigate([this.routes.HOME]);
        },
        ({ error }) => {
          this.errorMessages = Object.values(error);
        },
      );
    }
  }
}
