<?php
namespace Home\Controller;
use Think\Controller;
use Common\Controller\BaseController;
use Think\Base;

class TeamController extends BaseController {
    /*
     * 公共方法
     */
    Public function _initialize()
    {
        parent::_initialize();
    }

    public function index($id)
    {
        $staff_list = D('staff')->where(array('staff_status' => 1))->order('id ASC')->select();

        $this->assign('staff_list', $staff_list);
        $this->assign('menu_id', $id);
        $this->display('Main/team');
    }
}