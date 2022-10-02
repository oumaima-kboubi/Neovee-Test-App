import { Component, OnInit } from '@angular/core';
import {User} from "../../model/User";
import {NgForm} from "@angular/forms";
import {Article} from "../../model/Article";

@Component({
  selector: 'app-article-card',
  templateUrl: './article-card.component.html',
  styleUrls: ['./article-card.component.css']
})
export class ArticleCardComponent implements OnInit {
  test : Date = new Date();
  focus: any;
  focus1 : any;
 article: Article = new Article();
  errorMessage='';
  constructor() { }
  onSubmit(addArticleFormulaire: NgForm){
    const link =['login'];
    console.log(addArticleFormulaire.value);
    // this.authService.userRegister(registerFormulaire.value).subscribe(
    //   (response)=>{
    //     this.router.navigate(link)
    //   },
    //   (error)=>{
    //     this.errorMessage = `Problème de cnx à register server`;
    //     console.log(error);
    //   }
    // );

  }
  ngOnInit(): void {
  }

}
