import { ActivityDetailsComponent, ActivityNewComponent } from './pages';
import {
  ActivityEnrolleesTableComponent,
  ActivityFormComponent,
  ActivityPriceDialogBoxComponent,
  ActivityPriceTableComponent,
  ActivityTableComponent
} from './components/';

import { ActivityPageComponent } from './activity-page.component';
import { ActivityRoutingModule } from './activity-routing.module';
import { MaterialModule } from 'src/app/shared/material.module';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from '../../shared/shared.module';

const declarations = [
  ActivityDetailsComponent,
  ActivityEnrolleesTableComponent,
  ActivityFormComponent,
  ActivityNewComponent,
  ActivityPageComponent,
  ActivityPriceDialogBoxComponent,
  ActivityPriceTableComponent,
  ActivityTableComponent,
];
const imports = [
  ActivityRoutingModule,
  MaterialModule,
  ReactiveFormsModule,
  SharedModule,
];

@NgModule({
  declarations,
  imports,
})
export class ActivityModule { }
