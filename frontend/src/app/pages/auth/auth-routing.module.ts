import { RouterModule, Routes } from '@angular/router';

import { AuthPageComponent } from './page/auth-page.component';
import { NgModule } from '@angular/core';
import { LoginFormComponent } from './components/login-form/login-form.component';
import { SignFormComponent } from './components/sign-form/sign-form.component';

const routes: Routes = [
  {
    path: '',
    component: LoginFormComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AuthRoutingModule {}
