import {
  HttpErrorResponse,
  HttpEvent,
  HttpHandler,
  HttpInterceptor,
  HttpRequest,
} from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { AppSettings } from 'src/app/app.settings';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class JWTInterceptorService implements HttpInterceptor {
  constructor(private router: Router) {}

  intercept(
    req: HttpRequest<any>,
    next: HttpHandler,
  ): Observable<HttpEvent<any>> {
    const token: string = localStorage.getItem(
      AppSettings.APP_LOCALSTORAGE_TOKEN,
    );

    let request = req;

    if (token) {
      request = req.clone({
        setHeaders: {
          token: token,
        },
      });
    }

    return next.handle(request).pipe(
      catchError((err: HttpErrorResponse) => {
        if (err.status === 401) {
          localStorage.removeItem(AppSettings.APP_LOCALSTORAGE_TOKEN);
          this.router.navigateByUrl('/login');
        }

        return throwError(err);
      }),
    );
  }
}
