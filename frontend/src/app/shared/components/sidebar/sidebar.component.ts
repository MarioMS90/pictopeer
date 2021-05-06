import { AppSettings } from 'src/app/app.settings';
import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { routes } from '../../../consts/routes';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss']
})
export class SidebarComponent {
  public routes: typeof routes = routes;
  public isOpenUiElements = false;

  constructor(
    private readonly router: Router, 
  ) { }
  
  public openUiElements() {
    this.isOpenUiElements = !this.isOpenUiElements;
  }
  public logout() {
    localStorage.removeItem(AppSettings.APP_LOCALSTORAGE_TOKEN);
    this.router.navigate([routes.LOGIN]);
  }
}
