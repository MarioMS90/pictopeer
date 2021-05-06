import * as moment from 'moment';

import { Activity, ActivityPrice } from 'src/app/shared/models/activity.interface';
import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

import { paymethods } from '../../shared/activity_paymethod';
import { types } from '../../shared/activity_types';

@Component({
  selector: 'app-activity-form',
  templateUrl: './activity-form.component.html',
  styleUrls: ['./activity-form.component.scss']
})
export class ActivityFormComponent implements OnInit {
  form: FormGroup;
  prices: ActivityPrice[];
  paymethods = paymethods;
  types = types;

  
  @Input() activity: Activity = {} as Activity;
  @Output() onsave: EventEmitter<any> = new EventEmitter();
  
  constructor(
    private readonly formBuilder: FormBuilder,
  ) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      id: [this.activity.id],
      name: [this.activity.name, [Validators.required, Validators.maxLength(255)]],
      description: [this.activity.description, [Validators.required, Validators.maxLength(4000)]],
      type: [this.activity.type, [Validators.required]],
      inscription_date_start: [moment.unix(this.activity.inscription_date_start), [Validators.required]],
      inscription_date_end: [moment.unix(this.activity.inscription_date_end), [Validators.required]],
      paymethod: [this.activity.paymethod, [Validators.required]],
    });
  }

  onPricesUpdated(prices: ActivityPrice[]) {
    this.prices = prices;
  }
  save() {
    const activity = {
      ...this.form.value,
      inscription_date_start: this.form.value.inscription_date_start.unix(),
      inscription_date_end: this.form.value.inscription_date_end.unix(),
      prices: this.prices,
    };
    this.onsave.emit(activity);
  }
}
