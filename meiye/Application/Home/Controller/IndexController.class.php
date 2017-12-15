<?php
namespace Home\Controller;
use Think\Controller;
use Common\Controller\BaseController;
use Think\Base;

class IndexController extends BaseController {
	/*
	 * 公共方法
	 */
	public function _initialize()
	{
		parent::_initialize();
	}

	//首页
	public function index()
	{
		//首页关于云绣介绍，关于云绣下的单页模式下为开启状态排序最低的一条
		$about = D('column')->where(array('column_leftid' => 1, 'column_open' => 1))->order('column_order ASC')->limit(1)->find();
		if( ! empty($about))
		{
			$about = html_entity_decode($about['column_content']);
			//去除图片和html标签
			$about = strip_tags(preg_replace('/<img.*[^>]>/', '', $about));
			$this->assign('about', $about);
		}

		//首页调用banner
		parent::banner();

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