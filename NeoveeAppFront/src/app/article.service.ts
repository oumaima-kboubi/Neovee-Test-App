import {Injectable} from '@angular/core';
import {HttpClient, HttpParams} from "@angular/common/http";
import {User} from "./model/User";
import {map, Observable} from "rxjs";
import {Article} from "./model/Article";

@Injectable({
  providedIn: 'root'
})
export class ArticleService {
  link = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) {
  }

  addArticle(article: Article): Observable<any> {
    return this.http.post("http://127.0.0.1:8000/addArticle/", article).pipe(
      map((data: any) => {
        if (!data) {
          console.log("empty article response");
        }
        console.log(data);
      })
    );
  }

  getAllArticles(): Observable<any> {
    return this.http.get<any>("http://127.0.0.1:8000/getAllArticles/");
  }

  getMyArticles(): Observable<any> {
    let queryParams = new HttpParams();
    queryParams = queryParams.append("username", localStorage.getItem('username'));
    return this.http.get<any>("http://127.0.0.1:8000/getMyArticles/", {params: queryParams});
  }

  // getAuthor( id: number):Observable<any>{
  //   let queryParams = new HttpParams();
  //   queryParams = queryParams.append("id",id);
  //   return this.http.get<any>("http://127.0.0.1:8000/getAuthor/",{params:queryParams});
  // }
  deleteArticle(id:number): Observable<any> {
  let queryParams = new HttpParams();
  queryParams = queryParams.append("id", id);
  return this.http.delete("http://127.0.0.1:8000/deleteArticle/", {params: queryParams});
}
}
