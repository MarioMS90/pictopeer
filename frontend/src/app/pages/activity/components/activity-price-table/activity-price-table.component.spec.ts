import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivityPriceTableComponent } from './activity-price-table.component';

describe('ActivityPriceTableComponent', () => {
  let component: ActivityPriceTableComponent;
  let fixture: ComponentFixture<ActivityPriceTableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActivityPriceTableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivityPriceTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
