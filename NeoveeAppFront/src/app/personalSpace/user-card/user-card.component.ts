import { Component, OnInit } from '@angular/core';
import {User} from "../../model/User";

@Component({
  selector: 'app-user-card',
  templateUrl: './user-card.component.html',
  styleUrls: ['./user-card.component.css']
})
export class UserCardComponent implements OnInit {
user: User = new User(1,'oumaima','123');

  constructor() { }

  ngOnInit(): void {
  }

}
