<?php
namespace app\index\controller;     //命名空间，也说明了文件所在的文件夹
use think\Controller;
use think\Request;
use think\Db;   // 引用数据库操作类

class TestController extends IndexController
{

    public function index() 
    {
        return $this->fetch();
    }

    public function test() 
    {
        return $this->fetch();
    }

    public function A() 
    {
        return 'lllll';
    }

}