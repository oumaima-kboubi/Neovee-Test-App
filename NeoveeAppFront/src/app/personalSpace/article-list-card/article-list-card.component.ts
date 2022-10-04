import {Component, Input, OnInit} from '@angular/core';
import {Router} from "@angular/router";
import {ArticleService} from "../../article.service";

@Component({
  selector: 'app-article-list-card',
  templateUrl: './article-list-card.component.html',
  styleUrls: ['./article-list-card.component.css']
})
export class ArticleListCardComponent implements OnInit {

  @Input() title
  @Input() content
  @Input() author
  @Input() id
  @Input() updateDate
  @Input() heartColor
  constructor(
    private router:Router,
    private articleService: ArticleService,
  ) { }
  hideLike:any;

  ngOnInit(): void {
    if(localStorage.getItem('username')=== this.author){
      this.hideLike= true;
    }else{
      this.hideLike= false;
    }
    //using the username we will verify if the article is liked or not and change to the fitting color
    this.heartColor='#383737';
  }
  likeArticle(id:number){
        this.heartColor='orangered'
        this.articleService.addLike(id).subscribe(

        )
        // likeArticle
  }
  // showPreview(id:number){
  //   this.router.navigate(['previewArticle/'+id]);
  // }

}
