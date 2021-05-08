import {Injectable} from '@angular/core';
import {
  HttpEvent, HttpInterceptor, HttpHandler, HttpRequest, HttpXsrfTokenExtractor
} from '@angular/common/http';

import { Observable } from 'rxjs';

@Injectable()
export class HttpXsrfInterceptor implements HttpInterceptor {
  headerName = 'X-XSRF-TOKEN';

  constructor(private tokenService: HttpXsrfTokenExtractor) {}

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

    if (req.method === 'GET' || req.method === 'HEAD') {
      return next.handle(req);
    }

    const token = this.tokenService.getToken();
 
    // Be careful not to overwrite an existing header of the same name.
    if (token !== null && !req.headers.has(this.headerName)) {
      console.log('hola')
      req = req.clone({headers: req.headers.set(this.headerName, token)});
      console.log(req.headers.get(this.headerName))
    }
    req = req.clone({headers: req.headers.set(this.headerName, 'eyJpdiI6IjFmZ3c5RjN5Rjg5Z1ZcL3FCQ25HbG5RPT0iLCJ2YWx1ZSI6ImNTMUMyVDVzZnl2Ynhrc2xRSGVqMDYwUG5tQ2tuYkJISGRlQVhPMmtKNTMrRFExTktjYVVKZ1l0MXRJN0N2eUU3OXRcLzQxdG1CdmUxOEIxVFV3Skc5MWxSODQ3bVwvVGVxV1MyNFc2MWhSdXF3aUt1MHE5aGFcL2t6RWl3UVdYOWViIiwibWFjIjoiNGY0NmEwZWRmYTYxMDZmZTI0MzY3ZWJmNjZjNjcyYjU3OTcyNDUxNGM0ZDM0OTk5ZjllN2EzYzQzMjQ4ZjZlMiJ9')});
    req = req.clone({headers: req.headers.set('pictopeer_session', 'eyJpdiI6InN1cW9MRzVTRHhKRWY0bTZLelV0WFE9PSIsInZhbHVlIjoibHRYTUFHZGp0QVFLZUwyTnJRTkk1eStKcFh6V1dOWE5wcm5QWkNCdnY4bEhqR1lJUXNiQWk0c3BjaEdhWnlGNGY0SEFxMkMyaUI5cVpWckRPTVBSTVlJbDdvVmJ2eTdqbXBrVDlzcmppTFBObkN5UmNsVkFWOTR4OTVmTG96NXQiLCJtYWMiOiI4OTkxOTk4YzU2YWY2OGQwOGU0ZTM5M2MwNDZkMGM5ZDc1MjY4MDhmYzA0YmU1NWE3YTQwYzVmNWQ5OGNlMWU1In0%3D')});
    console.log(req.headers.get(this.headerName))
    console.log('hola')
    return next.handle(req);
  }
}