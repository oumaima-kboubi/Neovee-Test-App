import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {ROUTING} from "./app.routing";
import { LoginComponent } from './auth/login/login.component';
import {FormsModule} from "@angular/forms";
import { RegisterComponent } from './auth/register/register.component';
import { NavbarComponent } from './shared/navbar/navbar.component';
import { FooterComponent } from './shared/footer/footer.component';



@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    NavbarComponent,
    FooterComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,

    FormsModule,
    ROUTING,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
