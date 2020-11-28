import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BlogComponent } from './blog/blog.component';
import { HomeComponent } from './home/home.component';
import { MainComponent } from './main.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

//import { MainComponent } from './Main/Main.component';

import { MainRoutingModule } from './main-routing.module';
import { ShowblogComponent } from './showblog/showblog.component';


@NgModule({
  declarations: [BlogComponent,HomeComponent,MainComponent, ShowblogComponent],
  imports: [
    CommonModule,
    MainRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule

  ],
  exports:[FormsModule,ReactiveFormsModule]

})
export class MainModule { }
