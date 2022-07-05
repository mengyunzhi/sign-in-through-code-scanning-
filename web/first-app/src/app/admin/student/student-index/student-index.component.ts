import {Component, OnInit} from '@angular/core';
import {Student} from '../../../entity/student';
import {HttpClient} from '@angular/common/http';
import {Page} from '../../../entity/page';
import {StudentService} from '../../../service/student.service';
import {CommonService} from '../../../service/common.service';

@Component({
  selector: 'app-student-student-index',
  templateUrl: './student-index.component.html',
  styleUrls: ['./student-index.component.css']
})
export class StudentIndexComponent implements OnInit {
  // 默认显示第一页内容
  page = 0;
  // 每页默认5条
  size = 5;

  // 初始化一个有0条数据的分页
  pageDate = new Page<Student>({
    content: [],
    number: this.page,
    size: this.size,
    numberOfElements: 0
  });

  constructor(private httpClient: HttpClient,
              private studentService: StudentService,
              private commonService: CommonService) {
  }

  ngOnInit(): void {
    this.loadByPage();
  }

  onPage(page: number): void {
    this.loadByPage(page);
  }

  /**
   * 获取页面数据
   * @param page pageDte
   */
  loadByPage(page = 0): void {
    console.log('触发loadByPage方法');
    this.studentService.page({page, size: this.size})
      .subscribe(pageDate => {
      // 请求数据之后设置当前页
      console.log('请求成功', pageDate);
      this.page = page;
      this.pageDate = pageDate;
    });
  }


  /**
   * 删除
   */
  onDelete(studentId: number): void {
    this.commonService.confirm((confirm) => {
      if (confirm) {
        this.studentService.delete(studentId)
          .subscribe(() => {
            console.log('删除成功');
          }, error => console.log('删除失败'));
      }
    });
  }
}
