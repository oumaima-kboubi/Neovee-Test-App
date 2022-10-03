import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-my-space-article-card',
  templateUrl: './my-space-article-card.component.html',
  styleUrls: ['./my-space-article-card.component.css']
})
export class MySpaceArticleCardComponent implements OnInit {
  @Input() title
  @Input() content
  @Input() author
  @Input() id
  @Input() updateDate
  constructor() { }

  ngOnInit(): void {
  //   if(localStorage.getItem('username')=== this.author){
  //     this.hideLike= true;
  //   }else{
  //     this.hideLike= false;
  //   }
  //   console.log(this.hideLike);
  }

}
