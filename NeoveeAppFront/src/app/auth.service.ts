import {Injectable} from '@angular/core';
import {User} from "./model/User";
import {Observable, of, map, BehaviorSubject} from "rxjs";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {conditionallyCreateMapObjectLiteral} from "@angular/compiler/src/render3/view/util";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  link = 'http://127.0.0.1:8000';
  //jwtHelper = new JwtHelperService();
//  userInfo = new BehaviorSubject(null);
  constructor(private http: HttpClient) {
  }

  userRegister(user: User): Observable<any> {
    //console.log(user);
    return this.http.post("http://127.0.0.1:8000/register/", user).pipe(
      map((data:any)=>{
        if(!data) {
          console.log("empty register response");
        }
        console.log("this is my data:");
        console.log(data);
      })
    );
  }
  userLogin(user: User): Observable<any> {
      return this.http.post("http://127.0.0.1:8000/api/login",user).pipe(
        map((data:any)=>{
          if(!data) {
            console.log("empty login response");
          }
          localStorage.setItem('id',data.id)
          localStorage.setItem('username',data.username)
          // console.log("this is my data:");
          // console.log(data);
        })
      );;

  }
  // userLogin(login: any): Observable<boolean> {
  //   if (login && login.email && login.password) {
  //     return this.http.post("http://localhost:3000/auth/login",login).pipe(
  //       map((data: any) => {
  //         if (!data) {
  //           return false;
  //         }
  //         console.log("###################### decoded use")
  //         localStorage.setItem('access_token', data.access_token);
  //         localStorage.setItem('refresh_token', data.refresh_token);
  //         const decodedUser = this.jwtHelper.decodeToken(data.access_token);
  //         localStorage.setItem('expiration', decodedUser.exp);
  //         console.log(decodedUser)
  //         this.userInfo.next(decodedUser);
  //         return true;
  //       })
  //     );
  //   }
  //   return of(false);
  // }
}
