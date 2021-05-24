import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProfilePageComponent } from './pages/profile-page/profile-page.component';
import { SharedModule } from '../../shared/shared.module';
import { RouterModule } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { NavbarComponent } from 'src/app/shared/components/navbar/containers/navbar.component';

const declarations = [ProfilePageComponent];
const imports = [
  NavbarComponent,
  SharedModule,
  RouterModule,
  InfiniteScrollModule,
  CommonModule,
];

@NgModule({
  declarations: declarations,
  imports: imports,
})
export class ProfileModule {}
