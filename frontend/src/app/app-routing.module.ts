import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

import { AuthGuard } from './shared/guards';
import { NgModule } from '@angular/core';
import { HomePageComponent } from './pages/home';

const routes: Routes = [
  {
    path: 'home',
    component: HomePageComponent,
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, {
      preloadingStrategy: PreloadAllModules,
    })
  ],
  exports: [RouterModule],
})

export class AppRoutingModule {
}
