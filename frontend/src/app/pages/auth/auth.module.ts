import { AuthPageComponent } from './pages/auth-page.component';
import { AuthRoutingModule } from './auth-routing.module';
import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { LoginFormComponent } from './components/login-form/login-form.component';
import { RegisterFormComponent } from './components/register-form/register-form.component';

const declarations = [
  AuthPageComponent,
  LoginFormComponent,
  RegisterFormComponent,
];
const imports = [
  AuthRoutingModule,
  CommonModule,
  ReactiveFormsModule,
  FormsModule,
];
@NgModule({
  declarations,
  imports,
})
export class AuthModule {}
