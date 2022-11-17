import { Component, OnInit } from '@angular/core';
import {User} from '../../../entity/user';
import {UserService} from '../../../service/user.service';
import {Student} from '../../../entity/student';
import {StudentService} from '../../../service/student.service';

@Component({
  selector: 'app-personal-index',
  templateUrl: './personal-index.component.html',
  styleUrls: ['./personal-index.component.css']
})
export class PersonalIndexComponent implements OnInit {
  user = {}　as User;
  sno: string | undefined;
  constructor(private userService: UserService,
              private studentService: StudentService) { }

  ngOnInit(): void {
    this.userService.getCurrentLoginUser()
      .subscribe(user => {
        console.log('当前用户请求成功', user);
        this.user = user;
        if (+user.role === UserService.ROLE_STUDENT) {
          this.studentService.getById(user.id)
            .subscribe(student => {
              this.sno = student.sno;
            });
        }
      }, error => {
        console.log('当前用户请求失败', error);
      });
  }

}
