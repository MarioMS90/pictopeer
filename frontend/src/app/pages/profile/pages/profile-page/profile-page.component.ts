import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { images } from 'src/app/consts/images';
import { FriendRequest } from 'src/app/shared/models/friend-request.enum';
import { User, UserProfile } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-profile-page',
  templateUrl: 'profile-page.component.html',
  styleUrls: ['profile-page.component.scss'],
})
export class ProfilePageComponent implements OnInit {
  public user: User;
  public userProfile: UserProfile;
  public isOwnProfile: boolean = false;
  public images: typeof images = images;
  public isImageUploading = false;
  public friendRequestText = {
    [FriendRequest.ACCEPTED]: 'Agregado',
    [FriendRequest.PENDING]: 'Solicitud pendiente',
    null: 'Agregar',
  };
  public friendRequestClass = {
    [FriendRequest.ACCEPTED]: 'disabled',
    [FriendRequest.PENDING]: 'disabled',
    null: '',
  };

  constructor(
    private readonly userService: UserService,
    private readonly activatedRoute: ActivatedRoute,
  ) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;

      const userProfile$ = this.activatedRoute.paramMap.pipe(
        switchMap(params => {
          let alias = params.get('alias');

          if (!alias || alias === this.user.alias) {
            alias = this.user.alias;
            this.isOwnProfile = true;
          }

          return this.userService.getProfile(alias);
        }),
      );

      userProfile$.subscribe(userProfile => {
        this.userProfile = userProfile;
      });
    });
  }

  onImageSelected(event) {
    const image: File = event.target.files[0];

    if (image && this.isOwnProfile) {
      this.isImageUploading = true;
      const formData = new FormData();
      formData.append('image', image);

      this.userService.updateProfileImage(formData).subscribe(profileImage => {
        this.isImageUploading = false;
        this.userProfile.photoProfileUrl = profileImage.photoUrl;
      });
    }
  }

  sendFriendRequest() {
    if (!this.userProfile.friendStatus) {
      this.userService
        .createFriendRequest({
          idUserSender: this.user.id,
          idUserReceiver: this.userProfile.id,
          status: FriendRequest.PENDING,
        })
        .subscribe(() => {
          this.userProfile.friendStatus = FriendRequest.PENDING;
        });
    }
  }

  updateLikes(amount: number) {
    this.userProfile.likesReceivedCount =
      this.userProfile.likesReceivedCount + amount;
  }
}
