import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment.prod';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class GlobalService {

  constructor(private httpClient: HttpClient) { }
  private baseUrl = environment.BASE_URL;

  private handleError(errorResponse: HttpErrorResponse) {
    if (errorResponse.error instanceof ErrorEvent) {
        console.error('Client Side Error :', errorResponse.error.message);
    } else {
        console.error('Server Side Error :', errorResponse);
    }
    return throwError('There is a problem with the service. We are notified & working on it. Please try again later.');
}
getApi(url: string, token: any = ''): Observable<any> {

  let headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin': '*',
      'commtext': 'secrete',
      'AuthKey': token
  });
//   let headers = new HttpHeaders({
//     'Client-Service':'frontend-client',
//     'Content-Type': 'application/x-www-form-urlencoded',
//     'Access-Control-Allow-Origin': '*',
//     'commtext': 'secrete',
//     'AuthKey': token
// });

 console.log(headers);
 console.log(this.baseUrl + '' + url);

  return this.httpClient.get<any>(this.baseUrl + '' + url, { headers })
      .pipe(catchError(this.handleError));
}


postApi(url: string, data: any, token: any = ''): Observable<any> {

  let headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin': '*',
      'commtext': 'secrete',
      'AuthKey': token
  });
//   let headers = new HttpHeaders({
//     'Client-Service':'frontend-client',
//     'Content-Type': 'application/x-www-form-urlencoded',
//     'Access-Control-Allow-Origin': '*',
//     'commtext': 'secrete',
//     'AuthKey': token
// });


  console.log(headers);
  console.log(this.baseUrl + '' + url)
  return this.httpClient.post<any>(this.baseUrl + '' + url, data, { headers })
      .pipe(catchError(this.handleError));
}

updateApi(url: string, data: any, token: any = ''): Observable<any> {

  let headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin': '*',
      'commtext': 'secrete',
      'AuthKey': token
  });
//   let headers = new HttpHeaders({
//     'Client-Service':'frontend-client',
//     'Content-Type': 'application/x-www-form-urlencoded',
//     'Access-Control-Allow-Origin': '*',
//     'commtext': 'secrete',
//     'AuthKey': token
// });

   console.log(headers);
  console.log(data)
  return this.httpClient.put<any>(this.baseUrl + '' + url, data, { headers })
      .pipe(catchError(this.handleError));
}

deleteApi(url: string, Obj: any, token: any = ''): Observable<any> {
  const options = {
      headers: new HttpHeaders({
          'Content-Type': 'application/json',
          'Access-Control-Allow-Origin': '*',
          'commtext': 'secrete',
          'AuthKey': token,
      }),
    //    headers: new HttpHeaders({
    //     'Client-Service':'frontend-client',
    //     'Content-Type': 'application/x-www-form-urlencoded',
    //     'Access-Control-Allow-Origin': '*',
    //     'commtext': 'secrete',
    //     'AuthKey': token
    // }),

      body: Obj
  }
  console.log(options);

  return this.httpClient.delete<any>(this.baseUrl + '' + url, options)
      .pipe(catchError(this.handleError));

}
}
