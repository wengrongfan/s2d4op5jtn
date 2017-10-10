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
        $this->assign('menu_id', $id);
    }
}