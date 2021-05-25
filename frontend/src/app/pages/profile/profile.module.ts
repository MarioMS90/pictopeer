import { NgModule } from '@angular/core';
import { ProfilePageComponent } from './pages/profile-page.component';
import { SharedModule } from '../../shared/shared.module';
import { RouterModule } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';

const declarations = [ProfilePageComponent];
const imports = [
  SharedModule,
  RouterModule,
  InfiniteScrollModule,
  CommonModule,
  BrowserModule
];

@NgModule({
  declarations: declarations,
  imports: imports,
})
export class ProfileModule { }