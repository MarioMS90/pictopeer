import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

import { AuthGuard } from './shared/guards';
import { NgModule } from '@angular/core';
import { HomePageComponent } from './pages/home/page/home-page.component';
import { AuthPageComponent } from './pages/auth/page/auth-page.component';

const routes: Routes = [
  {
    path: '',
    component: AuthPageComponent,
    loadChildren: () =>
      import('./pages/auth/auth.module').then(m => m.AuthModule),
  },
  {
    path: 'home',
    component: HomePageComponent,
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, {
      preloadingStrategy: PreloadAllModules,
    }),
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
