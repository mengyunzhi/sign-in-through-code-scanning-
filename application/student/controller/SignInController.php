<?php
namespace app\student\controller;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\User;
use think\Request;
use think\Controller;

/**
 * 管理端
 */
class SignInController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        session_start();
        if ((int)User::isLogin() !== User::$ROLE_STUDENT) {
            return $this->error('当前未登录');
        }
    }

    public function index()
    {
        $map = ["id" => 1];
        $Student = Student::get($map);
        $this->assign('Student', $Student);
        return $this->fetch();
    }

    public function LoginSuccessV()
    {
        return $this->fetch();
    }   

    public function signIn()
    {
        return $this->success('签到成功', url('loginsuccessV'));  
    }

    public function PasswordSignIn()
    {
        return $this->fetch();
    }

    public function PasswordConfirmation()
    {
        return $this->fetch();
    }

    public function nosignin()
    {
        return $this->fetch();
    }

    public function alreadysignin()
    {
        return $this->fetch();
    }

}