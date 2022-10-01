import {Injectable} from '@angular/core';
import {User} from "./model/User";
import {Observable, of, map} from "rxjs";
import {HttpClient, HttpHeaders} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) {
  }

  userRegister(user: User): Observable<any> {
    //console.log(user);
    return this.http.post("http://127.0.0.1:8000/register/", user);
  }
  userLogin(user: User): Observable<any> {
      return this.http.post("http://127.0.0.1:8000/login/",user);

  }
}
