import { RouterModule, Routes } from '@angular/router';

import { ActivityDetailsComponent } from './pages/activity-details/activity-details.component';
import { ActivityNewComponent } from './pages/activity-new/activity-new.component';
import { ActivityPageComponent } from './activity-page.component';
import { ActivityTableComponent } from './components/activity-table/activity-table.component';
import { NgModule } from '@angular/core';

const routes: Routes = [
  {
    path: '',
    component: ActivityPageComponent,
    children: [
      { path: 'create', component: ActivityNewComponent },
      { path: ':id', component: ActivityDetailsComponent },
      { path: '', component: ActivityTableComponent },
    ],
  },
];

@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [RouterModule]
})

export class ActivityRoutingModule {
}
