import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { BrowserModule } from '@angular/platform-browser';
import { HttpXsrfInterceptor } from './shared/interceptors';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { SharedModule } from './shared/shared.module';
import { HomeModule } from './pages/home/home.module';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    AppRoutingModule,
    BrowserModule,
    HttpClientModule,
    RouterModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: HttpXsrfInterceptor,
      multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
