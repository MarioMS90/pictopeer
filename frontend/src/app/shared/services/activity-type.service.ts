import { Activity, ActivityType } from '../models/activity.interface';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { AbstractCrudService } from './crud.service';

@Injectable({
  providedIn: 'root',
})
export class ActivityTypeService extends AbstractCrudService<ActivityType> {
  constructor(http: HttpClient) {
    super(http, `${environment.APIENDPOINT_BACKEND}activity/type`);
  }
}
