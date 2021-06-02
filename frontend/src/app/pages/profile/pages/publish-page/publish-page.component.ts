import { Component, OnInit, ViewChild } from '@angular/core';
import { FileSystemFileEntry, NgxFileDropEntry } from 'ngx-file-drop';
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
      this.isImageUploading = true;
      const formData = new FormData();
      formData.append('image', this.image);
      formData.append('hashtags', JSON.stringify(hashtags.split(' ')));

      this.userService.createPost(formData).subscribe(asd => {
        this.imagePreview = null;
        this.isImageUploading = false;
        this.succesMessage = true;
      });
    }
  }
}
