import { HomePageComponent } from './pages/home-page.component';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from '../../shared/shared.module';
import { SuggestionsAsideComponent } from './components/suggestions-aside/suggestions-aside.component';
import { PostCardComponent } from './components/post-card/post-card.component';
import { RouterModule } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';

const declarations = [
  HomePageComponent,
  SuggestionsAsideComponent,
  PostCardComponent,
];
const imports = [
  ReactiveFormsModule,
  SharedModule,
  RouterModule,
  InfiniteScrollModule,
];

@NgModule({
  declarations,
  imports,
})
export class HomeModule {}
