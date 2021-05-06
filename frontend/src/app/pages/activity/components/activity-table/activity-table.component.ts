import { AfterViewInit, Component, ViewChild } from '@angular/core';

import { Activity } from 'src/app/shared/models/activity.interface';
import { ActivityService } from 'src/app/shared/services/activity.service';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';

@Component({
    selector: 'app-activity-table',
    templateUrl: './activity-table.component.html',
    styleUrls: ['./activity-table.component.scss']
})
export class ActivityTableComponent implements AfterViewInit{
    displayedColumns: string[] = ['id', 'name', 'description', 'inscription_date_start', 'inscription_date_end', 'type', 'paymethod'];
    @ViewChild(MatSort) sort: MatSort;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    dataSource: MatTableDataSource<Activity> = new MatTableDataSource();
  
   isEmptyActivity = this.isEmpty();

    constructor(
        private activityService: ActivityService,
    ){ }

    ngAfterViewInit() {
      this.activityService.findAll().subscribe(
        (activities) => {
          this.dataSource =  new MatTableDataSource(activities);
          this.dataSource.paginator = this.paginator;
          this.dataSource.sort = this.sort;
          this.isEmptyActivity = this.isEmpty();
        });
    }

    applyFilter(filterValue: string) {
      filterValue = filterValue.trim(); // Remove whitespace
      filterValue = filterValue.toLowerCase(); // Datasource defaults to lowercase matches
      this.dataSource.filter = filterValue;
    }
  
    isEmpty(): boolean {
      return this.dataSource.data.length === 0;
    }
}
