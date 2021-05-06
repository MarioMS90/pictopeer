import { NgModule } from '@angular/core';
import { ActivityTypePageComponent } from './activity-type-page.component';
import { MaterialModule } from 'src/app/shared/material.module';
import { SharedModule } from 'src/app/shared/shared.module';
import { ActivityTypeRoutingModule } from './activity-type-routing.module';

const declarations = [
  ActivityTypePageComponent,

];

const imports = [
  ActivityTypeRoutingModule,
  MaterialModule,
  SharedModule,
];

@NgModule({
  declarations,
  imports,
})
export class ActivityTypeModule { }
