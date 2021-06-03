import { Component, OnInit, ViewChild } from '@angular/core';
import { FileSystemFileEntry, NgxFileDropEntry } from 'ngx-file-drop';
import { User } from 'src/app/shared/models/user.interface';
import { UserService } from 'src/app/shared/services/user.service';

@Component({
  selector: 'app-friends-page',
  templateUrl: 'friends-page.component.html',
  styleUrls: ['friends-page.component.scss'],
})
export class FriendsPageComponent implements OnInit {
  public user: User;
  public isPostUploading = false;
  public image: File;
  public imagePreview: any;
  public succesMessage: boolean = false;

  @ViewChild('hashtags') inputHashtags;

  constructor(private readonly userService: UserService) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }

  public dropped(image: NgxFileDropEntry) {
    if (image[0].fileEntry.isFile) {
      const fileEntry = image[0].fileEntry as FileSystemFileEntry;
      const reader = new FileReader();

      fileEntry.file((file: File) => {
        this.image = file;

        reader.readAsDataURL(file);
        reader.onload = () => {
          this.imagePreview = reader.result;
        };
      });
    }
  }

  publish(hashtags) {
    if (this.image) {
      this.isPostUploading = true;
      const formData = new FormData();
      formData.append('image', this.image);
      formData.append('hashtags', JSON.stringify(hashtags.split(' ')));

      this.userService.createPost(formData).subscribe(asd => {
        this.imagePreview = null;
        this.isPostUploading = false;
        this.succesMessage = true;
      });
    }
  }
}
