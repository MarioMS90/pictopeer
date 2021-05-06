import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

import { Activity } from 'src/app/shared/models/activity.interface';
import { ActivityService } from 'src/app/shared/services/activity.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Observable } from 'rxjs';
import { switchMap } from 'rxjs/operators';

@Component({
  selector: 'app-activity-details',
  templateUrl: './activity-details.component.html',
  styleUrls: ['./activity-details.component.scss']
})
export class ActivityDetailsComponent implements OnInit {

  activity$: Observable<Activity>;

  constructor(
  
    private readonly snackBarService: MatSnackBar,
    private readonly activatedRoute: ActivatedRoute,
    private readonly router: Router,
    private readonly activityService: ActivityService,
  ) { }

  ngOnInit(): void {
   

    this.activity$ = this.activatedRoute.paramMap.pipe(
      switchMap(params => {
        const selectedId = Number(params.get('id'));
        return this.activityService.findOneById(selectedId);
      })
    );
    this.activity$.subscribe(() => {
   
    })
  }
  
  save(activity: Activity) {
    
    this.activityService.update(activity).subscribe(
      () => {
        this.showSnackBar({
          message: 'Operación realizada satisfactoriamente',
          title: 'ÉXITO',
        });
        this.router.navigateByUrl('/activity');
      },
      () => {
        this.showSnackBar({
          message: 'Operación no realizada debido a problemas con el servidor',
          title: 'ERROR',
        });
      },
    );
  }

  showSnackBar({ message, title }) {
    this.snackBarService.open(message, title, {
      duration: 4000,
    });
  }
  

}
