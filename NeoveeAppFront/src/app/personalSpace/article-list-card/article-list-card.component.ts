import {Component, Input, OnInit} from '@angular/core';
import {Router} from "@angular/router";

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
  constructor(
    private router:Router
  ) { }
  hideLike:any;
  ngOnInit(): void {
    if(localStorage.getItem('username')=== this.author){
      this.hideLike= true;
    }else{
      this.hideLike= false;
    }
    console.log(this.hideLike);
  }

  // showPreview(id:number){
  //   this.router.navigate(['previewArticle/'+id]);
  // }

}
