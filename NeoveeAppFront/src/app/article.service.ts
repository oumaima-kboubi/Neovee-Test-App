import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {User} from "./model/User";
import {map, Observable} from "rxjs";
import {Article} from "./model/Article";

@Injectable({
  providedIn: 'root'
})
export class ArticleService {
  link = 'http://127.0.0.1:8000';
  constructor(private http: HttpClient) { }

  addArticle(article: Article): Observable<any> {
    //console.log(user);
    return this.http.post("http://127.0.0.1:8000/addArticle/", article).pipe(
      map((data:any)=>{
        if(!data) {
          console.log("empty article response");
        }
        // console.log("this is my data:");
        console.log(data);
      })
    );
  }
}
