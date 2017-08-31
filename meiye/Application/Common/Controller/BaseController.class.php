<?php
namespace Common\Controller;
use Think\Controller;
use Think\Base;
use Think\Model;

//前台公共控制器
class BaseController extends CommonController {
	protected $sys = array('sys_name' , 'sys_title' , 'sys_key' , 'sys_des');
	protected function _initialize()
	{
		//站点信息
		$web_info = M('sys')->where(array('sys_id' => 1))->find();
		if(is_array($web_info) && ! empty($web_info))
		{
			foreach ($web_info as $key => $value)
			{
				if( ! in_array($key , $this->sys))
				{
					unset($web_info[$key]);
				}
			}
		}

		$this->assign('user_info' , $this->checkLogin());

		//外链
		$link = M('plug_link')->where(array('plug_link_open' => 1))->limit(15)->select();
		$this->assign('link' , $link);
		$this->assign('web_info' , $web_info);
	}

	/**
     * *检查是否有登录
     * @return Boolean          [description]
     */
	public function checkLogin()
	{
		if(session('user_id') !== NULL && session('user_id') > 0)
		{
			return array(
				'user_id' => session('user_id'),
				'username' => session('username'),
				'nick' => session('nick')
				);
		}
		return FALSE;
	}

	/**
     * *登陆权限检查
     * @return Boolean          [description]
     */
	public function authLogin()
	{
		if( ! $user = $this->checkLogin())
		{
			if(IS_AJAX)
			{
				$this->error('请先登录！' , U('User/login') , 1);
			}
			$this->redirect('User/login');
		}
		return $user;
	}
}