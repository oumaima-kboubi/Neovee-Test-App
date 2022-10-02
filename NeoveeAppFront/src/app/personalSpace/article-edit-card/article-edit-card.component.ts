import {Component, Input, OnInit} from '@angular/core';
import {Article} from "../../model/Article";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-article-edit-card',
  templateUrl: './article-edit-card.component.html',
  styleUrls: ['./article-edit-card.component.css']
})
export class ArticleEditCardComponent implements OnInit {
  test: Date = new Date();
  // @Input() articleId:number;
  focus: any;
  focus1: any;
  article: Article = new Article(2, 'test title', 'coznfnpfejlzeez\nfveveve\nvddefve');
  editReactiveForm: FormGroup;
  articleToEdit: Article = new Article(1, 'titre', 'contentttttttt\zefergerg\egerg');

  onSubmit() {
    console.log(this.editReactiveForm.value);

  }
  onReset(){
    this.editReactiveForm.reset();
  }

  constructor() {
  }

  ngOnInit(): void {
    this.editReactiveForm = new FormGroup({
      title: new FormControl(null, Validators.required),
      content: new FormControl(null, Validators.required),
    });
    this.editReactiveForm.patchValue({
      title: this.article.title,
      content: this.article.content,
    })


  }


}
