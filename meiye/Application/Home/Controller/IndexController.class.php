<?php
namespace Home\Controller;
use Think\Controller;
use Common\Controller\BaseController;
use Think\Base;

class IndexController extends BaseController {
	/*
	 * 公共方法
	 */
	Public function _initialize()
	{
		parent::_initialize();
	}

	//首页
	public function index()
	{
		//$Page  = new \Think\Page($total , C('DB_PAGENUM_20') , $page_map);// 实例化分页类 传入总记录数和每页显示的记录数
		//$show  = $Page->show();// 分页显示输出
		//$this->assign('page' , $show);
		$_SESSION['m_id'] = 0;//清除菜单选中
		$this->display('index');
	}

	public function about()
	{
		$this->display('main/about');
	}

	public function team()
	{
		$this->display('main/team');
	}

	public function news()
	{
		$this->display('main/news');
	}

	public function service()
	{
		$this->display('main/service');
	}

	public function contact()
	{
		$this->display('main/contact');
	}
}