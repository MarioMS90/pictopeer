//dialog-box.component.ts
import { Component, Inject, Optional } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { Activity, ActivityPrice } from 'src/app/shared/models/activity.interface';

interface ActivityPriceDialog extends ActivityPrice {
  action: string;
}

@Component({
  selector: 'app-activity-price-dialog-box',
  templateUrl: './activity-price-dialog-box.component.html',
  styleUrls: ['./activity-price-dialog-box.component.scss']
})
export class ActivityPriceDialogBoxComponent {

  action: string;
  form: FormGroup;

  constructor(
    private readonly formBuilder: FormBuilder,
    public dialogRef: MatDialogRef<ActivityPriceDialogBoxComponent>,

    @Optional() @Inject(MAT_DIALOG_DATA) public activityPrice: ActivityPriceDialog) {


    this.form = this.formBuilder.group({
      id: [this.activityPrice.id],
      name: [this.activityPrice.name, Validators.required],
      amount: [this.activityPrice.amount, Validators.required],
      
    });
  
    this.action = this.activityPrice.action;
  }

  doAction() {
    const data = { ...this.form.value };
    if (data.id === null) {
      delete data.id;
    }
    this.dialogRef.close({
       event: this.action,
       data,
    });
  }

  closeDialog(){
    this.dialogRef.close({ event:'Cancel' });
  }

}