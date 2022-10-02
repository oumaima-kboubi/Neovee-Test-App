export class Article {
   id: number;
  title: string;
   content:string;
   author:number;


  constructor(id = 0,title= '', content = '',author=0) {
    this.id = id;
    this.title = title;
    this.content = content;
    this.author= author;

  }
}
