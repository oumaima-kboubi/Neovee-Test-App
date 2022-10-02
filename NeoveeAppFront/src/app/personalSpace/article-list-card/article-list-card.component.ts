import {Component, Input, OnInit} from '@angular/core';
import {User} from "../../model/User";
import {Article} from "../../model/Article";
import {Router} from "@angular/router";

@Component({
  selector: 'app-article-list-card',
  templateUrl: './article-list-card.component.html',
  styleUrls: ['./article-list-card.component.css']
})
export class ArticleListCardComponent implements OnInit {
  user: User = new User(1,'oumaima','123');
  @Input() title
  @Input() content
  @Input() author
  @Input() id

  constructor(
    private router:Router
  ) { }

  ngOnInit(): void {
  }
  // showPreview(id:number){
  //   this.router.navigate(['previewArticle/'+id]);
  // }
  like(id: number){

  }
}
