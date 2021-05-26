import { HomePageComponent } from './pages/home-page.component';
import { NgModule } from '@angular/core';
import { SharedModule } from '../../shared/shared.module';
import { SuggestionsAsideComponent } from './components/suggestions-aside/suggestions-aside.component';
import { RouterModule } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';

const declarations = [HomePageComponent, SuggestionsAsideComponent];
const imports = [SharedModule, RouterModule, InfiniteScrollModule];

@NgModule({
  declarations,
  imports,
})
export class HomeModule {}
