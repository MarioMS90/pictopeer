import { Component, OnInit } from '@angular/core';

import { ActivityService } from 'src/app/shared/services/activity.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';

@Component({
  selector: 'app-activity-new',
  templateUrl: './activity-new.component.html',
  styleUrls: ['./activity-new.component.scss']
})
export class ActivityNewComponent implements OnInit {



  constructor(
    private readonly snackBarService: MatSnackBar,
    private readonly activityService: ActivityService,
    private readonly router: Router,
  ) { }

  ngOnInit(): void {
  }

  save(activity){
    
    this.activityService.add(activity).subscribe(
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
