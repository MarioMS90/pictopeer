import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { ProfilePageComponent } from './pages/profile-page.component';

const routes: Routes = [
  {
    path: '',
    component: ProfilePageComponent,
  },
  {
    path: ':alias',
    component: ProfilePageComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ProfileRoutingModule {}
