import { ActivityDetailsComponent, ActivityNewComponent } from './pages';
import {
  ActivityEnrolleesTableComponent,
  ActivityFormComponent,
  ActivityPriceDialogBoxComponent,
  ActivityPriceTableComponent,
  ActivityTableComponent
} from './components';

import { HomePageComponent } from './home-page.component';
import { ActivityRoutingModule } from './home-routing.module';
import { MaterialModule } from 'src/app/shared/material.module';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from '../../shared/shared.module';

const declarations = [
  ActivityDetailsComponent,
  ActivityEnrolleesTableComponent,
  ActivityFormComponent,
  ActivityNewComponent,
  HomePageComponent,
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
