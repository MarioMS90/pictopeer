import { AfterViewInit, Component, Input, OnInit, ViewChild } from '@angular/core';
import { MatTable, MatTableDataSource } from '@angular/material/table';

import { ActivityEnrollees } from 'src/app/shared/models/activity.interface';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';

@Component({
  selector: 'app-activity-enrollees-table',
  templateUrl: './activity-enrollees-table.component.html',
  styleUrls: ['./activity-enrollees-table.component.scss']
})
export class ActivityEnrolleesTableComponent implements AfterViewInit {
 
  displayedColumns: string[] = ['id', 'license', 'name', 'pay_date', 'price_name', 'price', 'paymethod', 'status'];
  dataSource: MatTableDataSource<ActivityEnrollees> = new MatTableDataSource();
  @Input() enrollees: ActivityEnrollees[];
 
  @ViewChild(MatTable, { static: true }) table: MatTable<ActivityEnrollees>;
  @ViewChild(MatSort) sort: MatSort;
  @ViewChild(MatPaginator) paginator: MatPaginator;

  isEmptyEnrollees = this.isEmpty();
  
  constructor(
    public dialog: MatDialog,
  ) { }

  ngAfterViewInit(): void {
    this.dataSource = new MatTableDataSource(this.enrollees);
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
    this.isEmptyEnrollees = this.isEmpty();
  }
 
  applyFilter(filterValue: string) {
    filterValue = filterValue.trim(); 
    filterValue = filterValue.toLowerCase(); 
    this.dataSource.filter = filterValue;
  }
  isEmpty(): boolean {
    return this.dataSource.data.length === 0;
  }

}
