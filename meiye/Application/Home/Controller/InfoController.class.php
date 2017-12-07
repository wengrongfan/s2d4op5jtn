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

        if($column['column_type'] != 5)
        {
            $this->error('栏目类型错误！本页不支持该栏目类型！');
        }

        $this->assign('column', $column);
        $this->assign('menu_id', $id);
        $this->display('main/about');
    }
}