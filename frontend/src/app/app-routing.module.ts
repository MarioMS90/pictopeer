import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './shared/guards/auth.guard';
import { NgModule } from '@angular/core';
import { HomePageComponent } from './pages/home/pages/home-page.component';
import { AuthPageComponent } from './pages/auth/pages/auth-page.component';
import { ProfilePageComponent } from './pages/profile/pages/profile-page/profile-page.component';
import { PublishPageComponent } from './pages/profile/pages/publish-page/publish-page.component';

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
    component: ProfilePageComponent,
  },
  {
    path: ':alias',
    canActivate: [AuthGuard],
    component: ProfilePageComponent,
  },
  {
    path: 'publish',
    canActivate: [AuthGuard],
    component: PublishPageComponent,
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
