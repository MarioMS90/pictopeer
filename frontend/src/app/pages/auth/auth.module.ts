import { AuthPageComponent } from './page/auth-page.component';
import { AuthRoutingModule } from './auth-routing.module';
import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { LoginFormComponent } from './components/login-form/login-form.component';
import { SignFormComponent } from './components/sign-form/sign-form.component';
import { AuthService } from 'src/app/shared/services/auth.service';

const declarations = [AuthPageComponent, LoginFormComponent, SignFormComponent];
const imports = [AuthRoutingModule, CommonModule, ReactiveFormsModule];
@NgModule({
  declarations,
  imports,
})
export class AuthModule {}
