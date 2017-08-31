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
		$this->display('index');
	}
}