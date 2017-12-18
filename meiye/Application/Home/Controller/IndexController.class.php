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
        $about['column_content'] = $this->fitld($about,'column_content');

        //首页栏目资讯
        $column = array();
        $temp_column = D('column')->where(array('column_open' => 1))->select();
        foreach ($temp_column as $value){
            $column[$value['c_id']] =$value;
            $column[$value['c_id']]['column_content'] = $this->fitld('','',$value['column_content'],1);
        }

        //首页新闻动态
		$c_ids = array();
		$columns = D('column')->where(array('column_leftid' => C('MENU_NEWS'), 'column_open' => 1))->field('c_id')->select();

		if( ! empty($columns))
		{
			foreach ($columns as $v)
			{
				$c_ids[] = $v['c_id'];
			}
		}
		$news_list = D('news')->where('news_columnid IN('.implode(',', $c_ids).') AND news_open = 1')->field('n_id,news_title,news_titleshort,news_time')->order('n_id DESC')->limit(5)->select();
		$postDate = array(
		    'culture'=>$column[C('CONTENT_CULTURE')],
		    'producer'=>$column[C('CONTENT_PRODUCER')],
		    'healthy'=>$column[C('CONTENT_HEALTHY')],
		    'face'=>$column[C('CONTENT_FACE')],
		    'body'=>$column[C('CONTENT_BODY')],
            'news_list'=>$news_list,
            'about'=>$about
        );
        $this->assignList($postDate);
		$_SESSION['m_id'] = 0;//清除菜单选中
		$this->display('index');

	}

    /**
     * 过滤html标记
     * @param $list
     * @param $des
     * @param $content
     * @param $num  为1的时候过滤单条信息
     */
	private function fitld($list='',$des,$content='',$num=0)
    {
        if ($num == 1){
            if (empty($content)){
                return false;
            }
            $name = strip_tags(html_entity_decode($content));
        }else{
            if (empty($list)){
                return false;
            }
            $name = strip_tags(html_entity_decode($list[$des]));
        }
        return $name;

    }
}