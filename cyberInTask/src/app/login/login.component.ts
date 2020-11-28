import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { GlobalService } from '../Sharing/global.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginform: FormGroup;
  msg: any;


  constructor(public formBuilder: FormBuilder,private globalService: GlobalService, public route: Router) { }

  ngOnInit(): void {

    this.loginform = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
    });


  }
  login()
  {
    let requestArray = {
      "username": this.loginform.value.username,
      "password": this.loginform.value.password
    }

     console.log(requestArray);
     this.globalService.postApi("login", requestArray, '').subscribe(
      respData => {
        console.log(respData);
        console.log("ok");
        if (respData.statusCode == 200) {

          sessionStorage.setItem("logged_in",respData.respData.user_token);
          sessionStorage.setItem("logged_in",respData.respData.user_id);
          alert(respData.statusMessage);
          this.route.navigate(["Main/home"]);
          console.log(respData);
         // console.log(RespData.respData.user_id);
         // console.log(RespData.respData.user_token);
         localStorage.setItem("user_id", respData.respData.user_id);
         localStorage.setItem("user_token", respData.respData.user_token);
        }
        else {
         // this.msg = RespData.message;
          alert(this.msg);
        }
      }
    );



  }

}
