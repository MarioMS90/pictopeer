import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-publish-page',
  templateUrl: 'publish-page.component.html',
  styleUrls: ['publish-page.component.scss'],
})
export class PublishPageComponent implements OnInit {
  public user: User;
  public isImageUploading = false;

  constructor(private readonly userService: UserService) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }

  onImageSelected(event) {
    const image: File = event.target.files[0];

    if (image) {
    }
  }
}
