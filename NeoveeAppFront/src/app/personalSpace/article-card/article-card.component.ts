import { Component, OnInit } from '@angular/core';
import {User} from "../../model/User";
import {NgForm} from "@angular/forms";
import {Article} from "../../model/Article";
import {ArticleService} from "../../article.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-article-card',
  templateUrl: './article-card.component.html',
  styleUrls: ['./article-card.component.css']
})
export class ArticleCardComponent implements OnInit {
  test : Date = new Date();
  focus: any;
  focus1 : any;
  // title:'';
  // content:'';
  userId: any;
  article: Article = new Article();
  errorMessage='';
  constructor(
    private articleService :ArticleService,
    private router: Router,
  ) { }
  onSubmit(addArticleFormulaire: NgForm){
    const link =['getAllArticles'];

    console.log(addArticleFormulaire.value);
    // this.title = addArticleFormulaire.value['title'];
    // this.content=addArticleFormulaire.value['content'];
    this.userId=localStorage.getItem('id');
    this.article.author=parseFloat( localStorage.getItem('id'));
    // console.log(addArticleFormulaire.value['title'])
    this.article.title=addArticleFormulaire.value['title'];
    this.article.content=addArticleFormulaire.value['content'];
    console.log(this.article);
    this.articleService.addArticle(this.article).subscribe(
      (response)=>{
        this.router.navigate(link)
      },
      (error)=>{
        // this.errorMessage = `Problème de cnx à register server`;
        console.log(error);
      }
    );

  }
  ngOnInit(): void {
  }

}
