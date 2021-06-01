import { Component, OnInit } from '@angular/core';
import { FileSystemDirectoryEntry, FileSystemFileEntry, NgxFileDropEntry } from 'ngx-file-drop';
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
  public files: NgxFileDropEntry[] = [];

  constructor(private readonly userService: UserService) { }

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
    });
  }

  public dropped(files: NgxFileDropEntry[]) {
    this.files = files;
    for (const droppedFile of files) {

      // Is it a file?
      if (droppedFile.fileEntry.isFile) {
        const fileEntry = droppedFile.fileEntry as FileSystemFileEntry;
        fileEntry.file((file: File) => {

          // Here you can access the real file
          console.log(droppedFile.relativePath, file);

          /**
          // You could upload it like this:
          const formData = new FormData()
          formData.append('logo', file, relativePath)

          // Headers
          const headers = new HttpHeaders({
            'security-token': 'mytoken'
          })

          this.http.post('https://mybackend.com/api/upload/sanitize-and-save-logo', formData, { headers: headers, responseType: 'blob' })
          .subscribe(data => {
            // Sanitized logo returned from backend
          })
          **/

        });
      } else {
        // It was a directory (empty directories are added, otherwise only files)
        const fileEntry = droppedFile.fileEntry as FileSystemDirectoryEntry;
        console.log(droppedFile.relativePath, fileEntry);
      }
    }
  }
}
