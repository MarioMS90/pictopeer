import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { NavbarComponent } from './components/navbar/containers/navbar.component';
import { AutocompleteLibModule } from 'angular-ng-autocomplete';

@NgModule({
  declarations: [NavbarComponent],
  imports: [RouterModule, CommonModule, FormsModule, AutocompleteLibModule],
  exports: [CommonModule, NavbarComponent],
})
export class SharedModule {}
