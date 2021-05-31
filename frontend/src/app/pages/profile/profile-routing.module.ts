import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { ProfilePageComponent } from './pages/profile-page/profile-page.component';
import { PublishPageComponent } from './pages/publish-page/publish-page.component';

const routes: Routes = [];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ProfileRoutingModule {}
