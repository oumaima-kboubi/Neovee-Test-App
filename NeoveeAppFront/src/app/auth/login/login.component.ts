import { Component, OnInit } from '@angular/core';
import {NgForm} from "@angular/forms";
import {AuthService} from "../../auth.service";
import {Router} from "@angular/router";
import {User} from "../../model/User";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  test : Date = new Date();
  focus: any;
  focus1 : any;
  user: User = new User();
  errorMessage='';

  constructor(
    private authService:AuthService,
    private router:Router
  ) { }

  //The login Method
  onSubmit(loginFormulaire: NgForm){
    console.log(loginFormulaire.value);
    const link =['landing'];
    this.authService.userLogin(loginFormulaire.value).subscribe(
        (response)=>{
         // const token = 'test';
          //localStorage.setItem('token',token) ;
          this.router.navigate(link);
        },
        (error)=>{
          this.errorMessage = `Problème de cnx pour login server`;
          console.log(error);
        }
      );
  }
  ngOnInit(): void {
  }

}
