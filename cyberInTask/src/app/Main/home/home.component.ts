import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { GlobalService } from 'src/app/Sharing/global.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  getshowblog: any;
  filterRecordBlog: any;

  constructor(public formBuilder:FormBuilder,private globalService: GlobalService, public route: Router) { }
  filterRecord:FormGroup;
  ngOnInit(): void {
    let token = localStorage.getItem("user_token");
    this.globalService.getApi("admin/viewblogs",token).subscribe(
      RespData => {
        if (RespData.statusCode == 200) {
          this.filterRecordBlog = RespData.respData;

          console.log(RespData)
          console.log(RespData.respData)
        }
        else {
          // alert(RespData.statusMessage);
          console.log(RespData)
        }
      }
    )
    this.filterRecord =this.formBuilder.group({
      title: [''],
      sub_title: [''],
       tags: [''],
       content: ['']


    });




  }
  filter()
  {
    let data={
      "title":this.filterRecord.value.title,
      "sub_title":this.filterRecord.value.sub_title,
      "tags":this.filterRecord.value.tags,
      "content":this.filterRecord.value.content

    }
    let token=localStorage.getItem("user_token");
    this.globalService.postApi("admin/fetch_fliter_data",data,token).subscribe(
   RespData =>{
        console.log(RespData);
            if(RespData.statusCode == 200){
              this.filterRecordBlog = RespData.respData;

              this.filterRecord.reset();
            }
            else{
              alert(RespData.statusMessage);

            }
           }
    )

  }



}
