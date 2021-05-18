import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { routes } from 'src/app/consts/routes';
import { AuthService } from '../../../../shared/services/auth.service';

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
    private readonly authService: AuthService,
    private readonly router: Router,
  ) {}

  public ngOnInit(): void {
    this.form = new FormGroup(
      {
        alias: new FormControl('', [
          Validators.required,
          Validators.maxLength(35),
        ]),
        email: new FormControl('', [
          Validators.required,
          Validators.email,
          Validators.maxLength(60),
        ]),
        password: new FormControl('', [
          Validators.required,
          Validators.minLength(8),
        ]),
        passwordConfirmation: new FormControl('', []),
      },
      {
        validators: this.password.bind(this),
      },
    );
  }

  public register(): void {
    if (this.form.valid) {
      this.authService.register({ ...this.form.value }).subscribe(
        () => {
          return this.router.navigate([this.routes.HOME]);
        },
        ({ error }) => {
          this.errorMessages = Object.values(error);
        },
      );
    }
  }

  password(formGroup: FormGroup) {
    const { value: password } = formGroup.get('password');
    const { value: passwordConfirmation } = formGroup.get(
      'passwordConfirmation',
    );

    return password === passwordConfirmation
      ? null
      : { passwordNotMatch: true };
  }
}
