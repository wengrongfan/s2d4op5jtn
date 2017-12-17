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
		//首页调用banner
		parent::banner();

		//首页关于云绣介绍，关于云绣下的单页模式下为开启状态排序最低的一条
		$about = D('column')->where(array('column_leftid' => 1, 'column_open' => 1))->order('column_order ASC')->limit(1)->find();
		if( ! empty($about))
		{
			//去除html标签
			$about = strip_tags(html_entity_decode($about['column_content']));
			$this->assign('about', $about);
		}

		//首页新闻动态
		$c_ids = array();
		$columns = D('column')->where(array('column_leftid' => C('MENU_NEWS'), 'column_open' => 1))->field('	c_id')->select();
		if( ! empty($columns))
		{
			foreach ($columns as $v)
			{
				$c_ids[] = $v['c_id'];
			}
		}
		$news_list = D('news')->where('news_columnid IN('.implode(',', $c_ids).') AND news_open = 1')->field('n_id,news_title,news_titleshort,news_time')->order('n_id DESC')->limit(5)->select();
		$this->assign('news_list', $news_list);

		$_SESSION['m_id'] = 0;//清除菜单选中
		$this->display('index');
	}

	/*public function about()
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
	}*/
}