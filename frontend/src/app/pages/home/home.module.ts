import { HomePageComponent } from './page/home-page.component';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from '../../shared/shared.module';
import { SuggestionsAsideComponent } from './components/suggestions-aside/suggestions-aside.component';
import { PostCardComponent } from './components/post-card/post-card.component';

const declarations = [
  HomePageComponent,
  SuggestionsAsideComponent,
  PostCardComponent
];
const imports = [
  ReactiveFormsModule,
  SharedModule
];

@NgModule({
  declarations,
  imports,
})
export class HomeModule { }
