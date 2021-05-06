import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivityEnrolleesTableComponent } from './activity-enrollees-table.component';

describe('ActivityEnrolleesTableComponent', () => {
  let component: ActivityEnrolleesTableComponent;
  let fixture: ComponentFixture<ActivityEnrolleesTableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActivityEnrolleesTableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivityEnrolleesTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
