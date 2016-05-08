<?php
// +----------------------------------------------------------------------
// | YFCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 http://www.rainfer.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: rainfer <81818832@qq.com>
// +----------------------------------------------------------------------
namespace Common\Controller;
use Common\Controller\CommonController;
use Think\Auth;
//权限认证
class AuthController extends CommonController {
	//初始化
	protected function _initialize(){
        parent::_initialize();
		//未登陆，不允许直接访问
		if(!$_SESSION['aid']){
			$this->error('还没有登录，正在跳转到登录页',U('Admin/Login/login'));
		}
		//已登录，不需要验证的权限
		$not_check = array('Sys/clear');//不需要检测的控制器/方法

		//当前操作的请求                 模块名/方法名
		//在不需要验证权限时
		if(in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $not_check)){
			return true;
		}
		//下面代码动态判断权限
		$auth = new Auth();
		if(!$auth->check(CONTROLLER_NAME.'/'.ACTION_NAME,$_SESSION['aid']) && $_SESSION['aid']!= 1){
			$this->error('没有权限',0,0);
		}
	}
}