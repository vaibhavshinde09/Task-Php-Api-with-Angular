import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { GlobalService } from 'src/app/Sharing/global.service';

@Component({
  selector: 'app-showblog',
  templateUrl: './showblog.component.html',
  styleUrls: ['./showblog.component.css']
})
export class ShowblogComponent implements OnInit {
  getshowblog: any;
  constructor(public formBuilder: FormBuilder,private globalService: GlobalService, public route: Router) { }

  ngOnInit(): void {
    let token = localStorage.getItem("user_token");
    this.globalService.getApi("admin/viewblogs",token).subscribe(
      RespData => {
        if (RespData.statusCode == 200) {
          this.getshowblog = RespData.respData;

          console.log(RespData)
          console.log(RespData.respData)
        }
        else {
          // alert(RespData.statusMessage);
          console.log(RespData)
        }
      }
    )


  }
  public deleteApi(id:number,i:number)
 {
  let obj={
    "id":id
  }
  let token=localStorage.getItem("user_token");
  this.globalService.deleteApi("admin/Deleteblogs",obj,token).subscribe(
    RespData =>{

      this.getshowblog.splice(i, 1);

      if(RespData.statusCode==200)
      {
        alert(RespData.statusMessage);
      }
      else{
        alert(RespData.statusMessage);

      }
    }
  )
 }

  editButtonClick(dataObj: any)
  {
    let obj = {
      title: dataObj["title"],
      sub_title: dataObj["sub_title"],
      tags: dataObj["tags"],
      content: dataObj["content"],
      id: dataObj["id"]


    }
    this.route.navigate(['/Main/blog/', obj.id]);


  }


}
