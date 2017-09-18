<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class StaffController extends AuthController {

	protected $staff;

	public function __construct() {
		parent::__construct();
		$this->staff = M('staff');
	}

	public function list() {
		$key = I('key');
    	$opentype_check = I('opentype_check','');
    	//查询：时间格式过滤
    	$sldate = I('reservation','');//获取格式 2015-11-12 - 2015-11-18
    	$arr = explode(" - ",$sldate);//转换成数组
    	$arrdateone = strtotime($arr[0]);
    	$arrdatetwo = strtotime($arr[1].' 23:55:55');

    	//map架构查询条件数组
    	$map['staff_name']= array('like',"%".$key."%");
    	if ($opentype_check != ''){
    	$map['staff_status'] = array('eq',$opentype_check);
    	}
    	$map['create_time'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');

    	$count = $this->staff->where($map)->count();// 查询满足要求的总记录数
    	$Page = new \Think\Page($count, C('DB_PAGENUM'));// 实例化分页类 传入总记录数和每页显示的记录数
    	$show = $Page->show();// 分页显示输出
    	$list =$this->staff->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();

    	$this->assign('opentype_check',$opentype_check);
    	$this->assign('keyy',$key);
    	$this->assign('sldate',$sldate);
    	$this->assign('list',$list);
    	$this->assign('page',$show);
		$this->display();
	}

	public function add() {
		//
	}

	public function edit($id) {
		//
	}

	public function status($id) {
		//
	}

	public function del($id) {
		//
	}
}