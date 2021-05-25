import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './shared/guards/auth.guard';
import { NgModule } from '@angular/core';
import { HomePageComponent } from './pages/home/pages/home-page.component';
import { AuthPageComponent } from './pages/auth/pages/auth-page.component';
import { ProfilePageComponent } from './pages/profile/pages/profile-page.component';

const routes: Routes = [
  {
    path: '',
    component: AuthPageComponent,
    loadChildren: () =>
      import('./pages/auth/auth.module').then(m => m.AuthModule),
  },
  {
    path: 'home',
    canActivate: [AuthGuard],
    component: HomePageComponent,
  },
  {
    path: 'profile',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./pages/profile/profile.module').then(m => m.ProfileModule),
  },
  {
    path: '**',
    redirectTo: '',
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
