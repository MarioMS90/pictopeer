import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [

  ],
  imports: [
    RouterModule,
    CommonModule,
    FormsModule,
  ],
  exports: [
    CommonModule,
  ]
})
export class SharedModule { }
