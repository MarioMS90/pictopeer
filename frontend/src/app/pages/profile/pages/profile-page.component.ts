import { Component, OnInit } from '@angular/core';
import { images } from 'src/app/consts/images';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-profile-page',
  templateUrl: 'profile-page.component.html',
  styleUrls: ['profile-page.component.scss'],
})
export class ProfilePageComponent implements OnInit {
  public user: User;
  public images: typeof images = images;
  public isImageUploading = false;

  constructor(private readonly userService: UserService) { }

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }

  onFileSelected(event) {
    const file: File = event.target.files[0];

    if (file) {
      this.isImageUploading = true;
      const formData = new FormData();
      formData.append('image', file);

      this.userService.updateProfileImage(formData).subscribe(profileImage => {
        this.isImageUploading = false;
        this.user.photoProfileUrl = profileImage.photoUrl;
      });
    }
  }
}
