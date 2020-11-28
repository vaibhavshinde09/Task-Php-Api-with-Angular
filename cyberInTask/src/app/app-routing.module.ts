import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';

//const routes: Routes = [];
const routes: Routes = [
  { path: '', component: LoginComponent, pathMatch: "full" },
  { path: 'Main', loadChildren: () => import('./main/main.module').then(m => m.MainModule)},
  { path: 'signup', component:SignupComponent}
];


@NgModule({
  imports: [RouterModule.forRoot(routes, { useHash: true })],
  exports: [RouterModule]
})
export class AppRoutingModule { }



