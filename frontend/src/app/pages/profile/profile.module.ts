import { NgModule } from '@angular/core';
import { ProfilePageComponent } from './pages/profile-page.component';
import { SharedModule } from '../../shared/shared.module';
import { RouterModule } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { ProfileRoutingModule } from './profile-routing.module';

const declarations = [ProfilePageComponent];
const imports = [
  SharedModule,
  RouterModule,
  InfiniteScrollModule,
  ProfileRoutingModule,
];

@NgModule({
  declarations: declarations,
  imports: imports,
})
export class ProfileModule {}
