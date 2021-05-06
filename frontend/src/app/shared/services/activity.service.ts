import { Activity } from '../models/activity.interface';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { AbstractCrudService } from './crud.service';

@Injectable({
  providedIn: 'root',
})
export class ActivityService extends AbstractCrudService<Activity> {
  constructor(http: HttpClient) {
    super(http, `${environment.APIENDPOINT_BACKEND}activity`);
  }
}
