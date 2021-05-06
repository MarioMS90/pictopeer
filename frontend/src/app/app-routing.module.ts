import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

import { AuthGuard } from './shared/guards';
import { NgModule } from '@angular/core';
import { NotFoundComponent } from './pages/not-found/not-found.component';

const routes: Routes = [
  /* {
    path: 'dashboard',
    pathMatch: 'full',
    canActivate: [AuthGuard],
    component: DashboardPageComponent,
  }, */
  {
    path: 'activity',
    /* pathMatch: 'full', */
    canActivate: [AuthGuard],
    loadChildren: () => import('./pages/activity/activity.module').then((m) => m.ActivityModule),
  },
  {
    path: 'activity-type',
    canActivate: [AuthGuard],
    loadChildren: () => import('./pages/activity-type/activity-type.module').then((m) => m.ActivityTypeModule),
  },
  {
    path: '404',
    component: NotFoundComponent,
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/auth/auth.module').then(m => m.AuthModule),
  },
  {
    path: '**',
    redirectTo: '404',
  }
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
