import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { switchMap } from 'rxjs/operators';
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
  public isOwnProfile: boolean = false;
  public images: typeof images = images;
  public isImageUploading = false;

  constructor(
    private readonly userService: UserService,
    private readonly activatedRoute: ActivatedRoute,
  ) {}

  ngOnInit() {
    const user$ = this.activatedRoute.paramMap.pipe(
      switchMap(params => {
        const param = params.get('alias');

        return this.userService.find(param);
      }),
    );

    user$.subscribe(user => {
      this.user = user;
    });

    if (!this.user) {
      this.userService.getUser().subscribe(user => {
        this.user = user;
        this.isOwnProfile = true;
      });
    }
  }

  onImageSelected(event) {
    const image: File = event.target.files[0];

    if (image) {
      this.isImageUploading = true;
      const formData = new FormData();
      formData.append('image', image);

      this.userService.updateProfileImage(formData).subscribe(profileImage => {
        this.isImageUploading = false;
        this.user.photoProfileUrl = profileImage.photoUrl;
      });
    }
  }
}
