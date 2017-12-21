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
		
		if(I('action') == 'dosubmit') {
			$staff_name = I('staff_name');
			$staff_position = I('staff_position');
			$staff_description = I('staff_description');
			$staff_status = I('staff_status');

			if(empty($staff_name) OR empty($staff_position)) {
				$this->error('参数错误！');
			}

			if( ! isset($_FILES['pic_one']['tmp_name'])) {
				$this->error('请上传图片！');
			}

			//获取图片上传后路径
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
    		$upload->savePath  =     ''; // 设置附件上传（子）目录
    		$upload->saveRule  =     'time';
    		$info   =   $upload->upload();
    		$img_url='';
    		if($info)
            {
    			foreach($info as $file)
                {
    				$img_url='/uploads/'.$file['savepath'].$file['savename'];//如果上传成功则完成路径拼接

                    parent::createThumb($upload->rootPath.$file['savepath'].$file['savename'], 378, 287);
    			}
    		}

    		$insert = array(
    			'staff_name' => $staff_name,
    			'staff_position' => $staff_position,
    			'staff_description' => $staff_description,
    			'staff_pic' => $img_url,
    			'staff_status' => $staff_status,
    			'create_time' => time()
    			);
    		if($this->staff->add($insert)) {
    			$this->success('success', U('Staff/list'), 1);
    		} else {
    			$this->error('数据保存失败!');
    		}
		}

		$this->display();
	}

	public function edit($id) {

		$staff = $this->staff->where(array('id' => $id))->find();
		if(empty($staff)) {
			$this->error('员工信息不存在!');
		}

		if(I('action') == 'dosubmit') {
			
			$staff_name = I('staff_name');
			$staff_position = I('staff_position');
			$staff_description = I('staff_description', TRUE);
			$staff_status = I('staff_status');

			if(empty($staff_name) OR empty($staff_position)) {
				$this->error('参数错误！');
			}

			$staff_pic = $staff['staff_pic'];
			//重置图片
			if(isset($_FILES['pic_one']['tmp_name'])) {
				
				//获取图片上传后路径
	    		$upload = new \Think\Upload();// 实例化上传类
	    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
	    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    		$upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
	    		$upload->savePath  =     ''; // 设置附件上传（子）目录
	    		$upload->saveRule  =     'time';
	    		$info   =   $upload->upload();
	    		if($info)
	    		{
	    			foreach($info as $file)
	    			{
	    				$staff_pic='/uploads/'.$file['savepath'].$file['savename'];

	    				parent::createThumb($upload->rootPath.$file['savepath'].$file['savename'], 378, 287);
	    			}
	    		}
			}

			$update = array(
				'id' => $id,
				'staff_name' => $staff_name,
				'staff_position' => $staff_position,
				'staff_pic' => $staff_pic,
				'staff_description' => $staff_description,
				'staff_status' => $staff_status
				);
			if($this->staff->save($update)) {
    			$this->success('success', U('Staff/list'), 1);
    		} else {
    			$this->error('数据保存失败!');
    		}
		}

		$this->assign('staff', $staff);
		$this->display();
	}

	public function status() {
		$id = I('x');
		$status = $this->staff->where(array('id'=>$id))->getField('staff_status');//判断当前状态情况
		if($status == 1){
			$statedata = array('staff_status'=>0);
			$auth_group=$this->staff->where(array('id'=>$id))->setField($statedata);
			$this->success('状态禁止',1,1);
		}else{
			$statedata = array('staff_status'=>1);
			$auth_group=$this->staff->where(array('id'=>$id))->setField($statedata);
			$this->success('状态开启',1,1);
		}
	}

	public function del($id) {
		$p = I('p');

		$staff = $this->staff->where(array('id' => $id))->find();
		if( ! empty($staff)) {

			if($this->staff->where('id ='.$id)->delete()) {
				$path = './Public'.$staff['staff_pic'];
				if(file_exists($path)) {
					@unlink($path);
				}
			}
		}
    	$this->success('success', U('Staff/list', array('p'=> $p)), 1);
	}
}