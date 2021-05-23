import { Component } from '@angular/core';
import { images } from 'src/app/consts/images';

@Component({
  selector: 'app-auth-page',
  templateUrl: './auth-page.component.html',
  styleUrls: ['./auth-page.component.scss'],
})
export class AuthPageComponent {
  public images: typeof images = images;
}
