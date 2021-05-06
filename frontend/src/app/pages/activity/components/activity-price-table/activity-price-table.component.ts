import { Component, EventEmitter, Input, OnInit, Output, ViewChild } from '@angular/core';
import { MatTable, MatTableDataSource } from '@angular/material/table';

import { ActivityPrice } from 'src/app/shared/models/activity.interface';
import { ActivityPriceDialogBoxComponent } from '../activity-price-dialog-box/activity-price-dialog-box.component';
import { MatDialog } from '@angular/material/dialog';

@Component({
  selector: 'app-activity-price-table',
  templateUrl: './activity-price-table.component.html',
  styleUrls: ['./activity-price-table.component.css']
})
export class ActivityPriceTableComponent implements OnInit {

  displayedColumns: string[] = ['id', 'name', 'amount', 'action'];
  dataSource: MatTableDataSource<any> = new MatTableDataSource();
  @Input() prices: ActivityPrice[];
  @Output() pricesUpdated: EventEmitter<ActivityPrice[]> = new EventEmitter();

  @ViewChild(MatTable, { static: true }) table: MatTable<any>;
  isEmptyPrice = this.isEmpty();
  
  constructor(
    public dialog: MatDialog,
  ) { }

  ngOnInit(): void {
    this.dataSource = new MatTableDataSource(this.prices);
    this.isEmptyPrice = this.isEmpty();
  }


  openDialog(action, obj) {
    obj.action = action;
    const dialogRef = this.dialog.open(ActivityPriceDialogBoxComponent, {
      width: '250px',
      data:obj
    });

    dialogRef.afterClosed().subscribe(result => {
      if(result.event == 'Add'){
        this.addRowData(result.data);
      }else if(result.event == 'Update'){
        this.updateRowData(result.data);
      }else if(result.event == 'Delete'){
        this.deleteRowData(result.data);
      }
    });
  }

  addRowData(price: ActivityPrice) {
    this.dataSource.data = [...this.dataSource.data, price ];
    this.pricesUpdated.emit(this.dataSource.data);
    this.isEmptyPrice = this.isEmpty();
  }
  updateRowData(price: ActivityPrice){
    const priceToUpdated = this.dataSource.data.find(data => data.id === price.id);
    priceToUpdated.amount = price.amount;
    priceToUpdated.name = price.name;
    this.pricesUpdated.emit(this.dataSource.data);
    this.isEmptyPrice = this.isEmpty();

  }
  deleteRowData(price: ActivityPrice) {
    this.dataSource.data = this.dataSource.data.filter(_price => _price.id !== price.id);
    this.pricesUpdated.emit(this.dataSource.data);
    this.isEmptyPrice = this.isEmpty();
  }

  isEmpty(): boolean {
    return this.dataSource.data.length === 0;
  }

}
