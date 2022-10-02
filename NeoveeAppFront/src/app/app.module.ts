import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {ROUTING} from "./app.routing";
import { LoginComponent } from './auth/login/login.component';
import {FormGroup, FormsModule, ReactiveFormsModule} from "@angular/forms";
import { RegisterComponent } from './auth/register/register.component';
import { NavbarComponent } from './shared/navbar/navbar.component';
import { FooterComponent } from './shared/footer/footer.component';
import { HttpClientModule} from "@angular/common/http";
import { LandingComponent } from './landing/landing.component';
import { SideBarComponent } from './personalSpace/side-bar/side-bar.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatCardModule} from "@angular/material/card";
import {MatFormFieldModule} from "@angular/material/form-field";
import { ArticleCardComponent } from './personalSpace/article-card/article-card.component';
import { UserCardComponent } from './personalSpace/user-card/user-card.component';
import { ArticleAddComponent } from './personalSpace/article-add/article-add.component';
import { ArticleEditComponent } from './personalSpace/article-edit/article-edit.component';
import { ArticleEditCardComponent } from './personalSpace/article-edit-card/article-edit-card.component';
import { ArticleListComponent } from './personalSpace/article-list/article-list.component';



@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    NavbarComponent,
    FooterComponent,
    LandingComponent,
    SideBarComponent,
    ArticleCardComponent,
    UserCardComponent,
    ArticleAddComponent,
    ArticleEditComponent,
    ArticleEditCardComponent,
    ArticleListComponent

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    ROUTING,
    BrowserAnimationsModule,
    MatCardModule,
    MatFormFieldModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
