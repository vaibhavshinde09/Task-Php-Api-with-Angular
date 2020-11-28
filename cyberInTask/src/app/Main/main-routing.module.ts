import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { MainComponent } from './main.component';
import { BlogComponent } from './blog/blog.component';
import { HomeComponent } from './home/home.component';
import { ShowblogComponent } from './showblog/showblog.component';

const routes: Routes = [

  {path:'',component:MainComponent,children:[
    {path:'home',component:HomeComponent},
    {path:'blog',component:BlogComponent},
    {path:'showblog',component:ShowblogComponent},
    {path:'blog/:uid',component:BlogComponent}


]}
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class MainRoutingModule { }
