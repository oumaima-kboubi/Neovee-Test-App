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


  onSubmit(loginFormulaire: NgForm){
    console.log(loginFormulaire.value);
    const link =['landing'];
    this.authService.userLogin(loginFormulaire.value).subscribe(
        (response)=>{
        //  console.log('i am before landing navigate')
          this.router.navigate(link)
         // console.log('i am after landing navigate')
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
