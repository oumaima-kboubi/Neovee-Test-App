export class Article {
  id: number;
  title: string;
  content:string;

  constructor(id = 0, title= '', content = '') {
    this.id = id;
    this.title = title;
    this.content = content;

  }
}
