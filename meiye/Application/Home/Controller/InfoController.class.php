<?php
namespace Home\Controller;
use Think\Controller;
use Common\Controller\BaseController;
use Think\Base;

class InfoController extends BaseController {
    /*
     * 公共方法
     */
    Public function _initialize()
    {
        parent::_initialize();
    }

    public function index($id)
    {
        $column = D('column')->where(array('c_id' => $id, 'column_open' => 1))->find();
        if(empty($column))
        {
            $this->error('内容不存在！');
        }

        //父类，随便取一个子类
        if($column['column_leftid'] == 0)
        {
            $column = D('column')->where(array('column_leftid' => $column['c_id'], 'column_open' => 1))->find();
            $this->assign('p_id', $id);
        }
        else
        {
            $parent = D('column')->where(array('c_id' => $column['column_leftid'], 'column_open' => 1))->find();
            $this->assign('p_id', $parent['c_id']);
        }

        $this->assign('column', $column);
        $this->assign('menu_id', $id);

        switch ($column['column_type'])
        {
            case 4:
                $this->error('栏目类型错误！本页不支持该栏目类型！');
                break;
            case 2:
                if(empty($column['column_address']))
                {
                    $this->error('跳转链接不存在！');
                }

                header('Location: '.$column['column_address']);
                break;
            //列表
            case 3:
                $this->list_view($column['c_id']);
                break;
            default:
                $this->display('main/about');
                break;
        }
    }

    public function list_view($column_id = 0)
    {
        $keyword = I('keyword', TRUE);

        $map = array();
        if( ! empty($keyword))
        {
            $map['news_title'] = array('like',"%".$keyword."%");
            $map['news_titleshort'] = array('like',"%".$keyword."%");
            $map['news_key'] = array('like',"%".$keyword."%");
            $where['_logic'] = 'or';
        }

        if($column_id > 0)
        {
            $map['news_columnid'] = $column_id;
        }
        $map['news_open'] = 1;
        //$this->assign('keyword', $keyword);

        $total = D('news')->where($map)->count();
        $Page = new \Think\Page($total , C('DB_PAGENUM_20'));
        $news_list = D('news')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('n_id DESC')->select();
        $show = $Page->show();
        $this->assign('page' , $show);
        $this->assign('news_list', $news_list);

        $column_list = D('column')->where('column_leftid > 0 AND column_open = 1')->select();
        $id2name = array();
        if( ! empty($column_list))
        {
            foreach ($column_list as $v)
            {
                $id2name[$v['c_id']] = $v['column_name'];
            }
        }

        $this->assign('id2name', $id2name);
        $this->display('main/news');
    }

    public function view($id)
    {
        $news = D('news')->where(array('n_id' => $id))->find();
        if(empty($news) OR $news['news_open'] != 1)
        {
            $this->error('信息不存在或者审核未通过！');
        }

        //点击加1
        D('news')->where(array('n_id' => $id))->setInc('news_hits', 1);

        $this->assign('menu_id', $news['news_columnid']);
        $this->assign('news', $news);
        $this->display('main/news_detail');
    }
}