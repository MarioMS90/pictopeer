import { LoginFormComponent, SignFormComponent } from './components';

import { AuthPageComponent } from './auth-page/auth-page.component';
import { AuthRoutingModule } from './auth-routing.module';
import { CommonModule } from '@angular/common';
import { MatButtonModule } from '@angular/material/button';
import { MatInputModule } from '@angular/material/input';
import { MatTabsModule } from '@angular/material/tabs';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { YearPipe } from 'src/app/shared/pipes/year.pipe';

const declarations = [
  AuthPageComponent,
  LoginFormComponent,
  SignFormComponent,
  YearPipe,
];
const imports = [
  AuthRoutingModule,
  CommonModule,
  MatTabsModule,
  MatButtonModule,
  MatInputModule,
  ReactiveFormsModule,
];
@NgModule({
  declarations,
  imports,
})
export class AuthModule { }
