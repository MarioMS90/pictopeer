import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { NavbarComponent } from './components/navbar/containers/navbar.component';
import { AutocompleteLibModule } from 'angular-ng-autocomplete';
import { UserSearchComponent } from './components/navbar/components/user-search/user-search.component';
import { NotificationFriendRequest } from './components/navbar/components/notification-friend-request/notification-friend-request';
import { PostCardComponent } from './components/post-card/post-card.component';

@NgModule({
  declarations: [
    NavbarComponent,
    UserSearchComponent,
    NotificationFriendRequest,
    PostCardComponent,
  ],
  imports: [RouterModule, CommonModule, FormsModule, AutocompleteLibModule],
  exports: [CommonModule, NavbarComponent, PostCardComponent],
})
export class SharedModule {}
