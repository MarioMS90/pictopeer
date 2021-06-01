import { NgModule } from '@angular/core';
import { ProfilePageComponent } from './pages/profile-page/profile-page.component';
import { SharedModule } from '../../shared/shared.module';
import { RouterModule } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { PublishPageComponent } from './pages/publish-page/publish-page.component';
import { NgxFileDropModule } from 'ngx-file-drop';

const declarations = [ProfilePageComponent, PublishPageComponent];
const imports = [SharedModule, RouterModule, InfiniteScrollModule, NgxFileDropModule];

@NgModule({
  declarations: declarations,
  imports: imports,
})
export class ProfileModule { }
