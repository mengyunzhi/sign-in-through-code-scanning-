<?php
namespace app\index\controller;
use app\common\model\Teacher;
use think\Request;
use think\Controller;
use app\index\controller\LoginController;

/**
 * 管理端
 */
class IndexController extends Controller
{		

	public function index()
	{
       	 return $this->fetch('login/index');
	}

}