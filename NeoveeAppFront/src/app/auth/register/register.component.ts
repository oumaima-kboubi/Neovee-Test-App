import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  test : Date = new Date();
  focus: any;
  focus1 : any;
  constructor() { }

  ngOnInit(): void {
  }

}
