<?php
namespace app\index\service;
use app\index\model\Menu;
use app\common\model\User;

class MenuService {

    static public function getMenus() {
        return isset($this->data['Menus'] ? $this->data['Menus'] : $this->data['Menus'] = [
            //教师端 web
            //
            //action改成index
            new Menu('index', 'task', 'index', '课程任务', [User::$ROLE_TEACHER]),
            new Menu('index', 'schedule', 'scheduleSort', '排课管理', [User::$ROLE_TEACHER]),
            new Menu('index', 'course', 'courseSort', '课程管理', [User::$ROLE_TEACHER]),
            new Menu('index', 'course_schedule', 'courseScheduleWeek', '课程表', [User::$ROLE_TEACHER]),
            new Menu('index', 'personal', 'index', '个人中心', [User::$ROLE_TEACHER]),
            new Menu('index', 'Login', 'webLogout', '注销', [User::$ROLE_TEACHER]),

            //管理端
            new Menu('admin', 'admin_term', 'index', '学期管理', [User::$ROLE_ADMIN]),
            new Menu('admin', 'admin_teacher', 'index', '教师管理', [User::$ROLE_ADMIN]),
            new Menu('admin', 'admin_student', 'index', '学生管理', [User::$ROLE_ADMIN]),
            new Menu('admin', 'admin_klass', 'index', '班级管理', [User::$ROLE_ADMIN]),
            new Menu('admin', 'admin_room', 'index', '教室管理', [User::$ROLE_ADMIN]),
            new Menu('admin', 'personal', 'index', '个人中心', [User::$ROLE_ADMIN]),
            new Menu('index', 'Login', 'webLogout', '注销', [User::$ROLE_ADMIN]),
        ];
    }    

    /**
     * 通过role获取符合权限的导航菜单
     * @param  [int] $role [权限]
     * @return [array]    [导航栏菜单]
     */
    static public function getAllowMenus($role) {
        $allowMenus = [];
        foreach (self::getMenus() as $Menu) {
            if (in_array($role, $Menu->roles)) {
                array_push($allowMenus, $Menu);
            }
        }
        return $allowMenus;
    }

    static public function getCurrentMenus() {
        $currentUser = User::getCurrentLoginUser();
        return self::getAllowMenus($currentUser->getRole());
    }

}