import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators} from '@angular/forms';
//import { Router,Params } from '@angular/router';
import { GlobalService } from 'src/app/Sharing/global.service';
import { ActivatedRoute,Params } from '@angular/router';

@Component({
  selector: 'app-blog',
  templateUrl: './blog.component.html',
  styleUrls: ['./blog.component.css']
})
export class BlogComponent implements OnInit {
BlogFrm:FormGroup;
  geteditBloglist: any;
  title: any;
  tags:any;
  content:any;
  sub_title:any;
  id: any;
  constructor(public formBuilder: FormBuilder,private globalService: GlobalService, public route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.params.subscribe((param: Params) => {
      let data = {

        id: param.uid

      };
      let token = localStorage.getItem("user_token");

      this.globalService.postApi("admin/edit_blog_data",data,token).subscribe(
        RespData => {
          console.log(RespData);
          if (RespData.statusCode == 200) {
            let obj=RespData.respData[0];
            this.geteditBloglist = RespData.respData;
            this.title=obj.title
            this.id=obj.id
            this.sub_title=obj.sub_title
            this.tags=obj.tags
            this.content=obj.content
                        console.log(RespData.respData)
          }
          else {
            // alert(RespData.statusMessage);
            console.log(RespData)
          }
        })


    });
    this.BlogFrm =this.formBuilder.group({
      title: ['', Validators.required],
      sub_title: ['', Validators.required],
       tags: ['', Validators.required],
       content: ['',Validators.required],
       id: ['',Validators.required]


    });


  }
  UpdateBlog()
  {
    let data={
      "id":this.BlogFrm.value.id,
      "title":this.BlogFrm.value.title,
      "sub_title":this.BlogFrm.value.sub_title,
      "tags":this.BlogFrm.value.tags,
      "content":this.BlogFrm.value.content

    }
    console.log(data);
    let token=localStorage.getItem("user_token");
    this.globalService.updateApi("admin/updateblogs",data,token).subscribe(
      RespData =>{
        if(RespData.statusCode == 200){
          alert(RespData.statusMessage);
          this.BlogFrm.reset();
        }
        else{
          alert(RespData.statusMessage);
        }
      }

    )
  }
  CreateBlog()
  {
    let data={
      "title":this.BlogFrm.value.title,
       "sub_title":this.BlogFrm.value.sub_title,
       "tags":this.BlogFrm.value.tags,
       "content":this.BlogFrm.value.content

    }
    console.log(data);
    let token = localStorage.getItem("user_token");
   console.log(token);
    this.globalService.postApi("admin/createblogs",data,token).subscribe(

      RespData =>{
        console.log(RespData);

            if(RespData.statusCode == 200){
              alert(RespData.statusMessage);
              this.BlogFrm.reset();
            }
            else{
              alert(RespData.statusMessage);

            }
           }
    )

  }
}
