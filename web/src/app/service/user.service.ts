import {BehaviorSubject, Observable} from 'rxjs';
import {HttpClient, HttpParams} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {User} from '../entity/user';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  static ROLE_ADMIN = 0;
  static ROLE_TEACHER = 1;
  static ROLE_STUDENT = 2;

  constructor(private httpClient: HttpClient) {
  }

  isLogin(moduleRole: number): Observable<boolean> {
    const httpParams = new HttpParams()
      .append('moduleRole', moduleRole.toString());
    return this.httpClient.get<boolean>('/user/isLogin', {params: httpParams});
  }

  login(phone: string, password: string): Observable<User>{
    const httpParams = new HttpParams()
      .append('number', phone)
      .append('password', password);
    return this.httpClient.get<User>('/user/login', {params: httpParams});
  }

  logout(): Observable<void> {
    return this.httpClient.get<void>('/user/logout');
  }

  getCurrentLoginUser(userNumber: string): Observable<User> {
    const httpParams = new HttpParams()
      .append('userNumber', userNumber);
    return this.httpClient.get<User>('/user/getCurrentLoginUser', {params: httpParams});
  }

  studentRegister(data: {sno: string, password: string, number: string}): Observable<boolean> {
    return this.httpClient.post<boolean>('/user/studentRegister', data);
  }

  userUpdate(data: { number: any; password: any; role: any; sex: any; name: any; id: number | undefined }): Observable<User> {
    return this.httpClient.post<User>('/user/userUpdate', data);
  }

  updateTeacherIndexPassword(newIndexPassWord: any): Observable<boolean> {
    console.log('service', newIndexPassWord);
    return this.httpClient.post<boolean>('/user/updateTeacherIndexPassword', newIndexPassWord);
  }

  getTeacherDefaultPassword(): Observable<string> {
    return this.httpClient.get<string>('/user/getTeacherDefaultPassword');
  }

  updateStudentIndexPassword(newIndexPassWord: any): Observable<boolean> {
    return this.httpClient.post<boolean>('/user/updateStudentIndexPassword', newIndexPassWord);
  }

  getStudentDefaultPassword(): Observable<string> {
    return this.httpClient.get<string>('/user/getStudentDefaultPassword');
  }
}
