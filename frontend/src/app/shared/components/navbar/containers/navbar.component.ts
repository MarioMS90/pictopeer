import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { routes } from 'src/app/consts/routes';
import { FriendRequest } from '../../../models/friend-request.enum';
import { ProfileSearch, User } from '../../../models/user.interface';
import { AuthService } from '../../../services/auth.service';
import { UserService } from '../../../services/user.service';

@Component({
  selector: 'app-navbar',
  templateUrl: 'navbar.component.html',
  styleUrls: ['navbar.component.scss'],
})
export class NavbarComponent implements OnInit {
  public user: User;
  public isFriendRequestsEmpty: boolean;
  public isNewLikesReceivedEmpty: boolean;
  public notificationsCount: number;
  public notificationsIsToggle: boolean;
  public profileImageIsToggle: boolean;
  private routes: typeof routes = routes;
  public keyword: string = 'alias';
  public profilesFound: ProfileSearch[];

  constructor(
    private readonly service: AuthService,
    private readonly userService: UserService,
    private readonly router: Router,
  ) {}

  ngOnInit() {
    this.userService.getUser().subscribe(user => {
      this.user = user;
      this.isFriendRequestsEmpty = user.friendRequests.length === 0;
      this.isNewLikesReceivedEmpty = user.newLikesReceived.length === 0;
    });
  }

  selectEvent(profile) {
    return this.router.navigate([`${this.routes.PROFILE}/${profile.alias}`]);
  }

  onChangeSearch(value) {
    if (value) {
      this.userService.searchUsersByAlias(value).subscribe(profilesFound => {
        this.profilesFound = profilesFound;
      });
    }
  }

  acceptFriendRequest = friendRequest =>
    this.updateFriendRequest({
      id: friendRequest.id,
      status: FriendRequest.ACCEPTED,
    });

  rejectFriendRequest = friendRequest =>
    this.updateFriendRequest({
      id: friendRequest.id,
      status: FriendRequest.REJECTED,
    });

  updateFriendRequest(friendRequest) {
    this.userService.updateFriendRequest(friendRequest).subscribe(status => {
      this.user.friendRequests = this.user.friendRequests.filter(
        _friendRequest => _friendRequest.id !== friendRequest.id,
      );

      this.isFriendRequestsEmpty = this.user.friendRequests.length === 0;
    });
  }

  notifyNewLikesViewed() {
    this.userService.notifyLikesViewed(this.user.newLikesReceived).subscribe();
  }

  logout(): void {
    this.service.logout().subscribe(
      () => {
        return this.router.navigate([this.routes.LOGIN]);
      },
      ({ error }) => {
        throw new Error(error.message);
      },
    );
  }
}
