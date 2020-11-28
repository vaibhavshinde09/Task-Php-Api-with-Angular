import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { GlobalService } from '../Sharing/global.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {
  registerform:FormGroup;

  constructor(public formBuilder: FormBuilder,private globalService: GlobalService, public route: Router) { }



  ngOnInit(): void {

    this.registerform = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required],
       user_email: ['', Validators.required]

    });

  }
  register()
  {
    let data={
      "username":this.registerform.value.username,
       "password":this.registerform.value.password,
       "user_email":this.registerform.value.user_email,

    }
    console.log(data);
    this.globalService.postApi("user_registr",data,'').subscribe(
      RespData =>{
        console.log(RespData);
            if(RespData.statusCode == 200){
              alert(RespData.statusMessage);
              this.registerform.reset();
            }
            else{
              alert(RespData.statusMessage);

            }
           }
    )

  }

}
