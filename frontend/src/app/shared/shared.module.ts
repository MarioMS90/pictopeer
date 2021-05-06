import { CommonModule } from '@angular/common';
import { DateMenuComponent } from './components/ui-elements';
import { FormsModule } from '@angular/forms';
import { HeaderModule } from './components/header/header.module';
import { LayoutComponent } from './components/layout/layout.component';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatListModule } from '@angular/material/list';
import { MatMenuModule } from '@angular/material/menu';
import { MatSelectModule } from '@angular/material/select';
import { MatSidenavModule } from '@angular/material/sidenav';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { SettingsMenuComponent } from './components/ui-elements/settings-menu/settings-menu.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';

@NgModule({
  declarations: [
    SidebarComponent,
    SettingsMenuComponent,
    DateMenuComponent,
    LayoutComponent
  ],
  imports: [
    HeaderModule,
    MatListModule,
    MatIconModule,
    RouterModule,
    MatButtonModule,
    CommonModule,
    MatMenuModule,
    MatSelectModule,
    FormsModule,
    MatSidenavModule
  ],
  exports: [
    CommonModule,
    HeaderModule,
    SidebarComponent,
    SettingsMenuComponent,
    DateMenuComponent,
    LayoutComponent
  ]
})
export class SharedModule { }
