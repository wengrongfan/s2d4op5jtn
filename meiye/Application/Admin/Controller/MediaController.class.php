<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class MediaController extends AuthController {

	protected $media;

	public function __construct() {
		parent::__construct();
		$this->media = M('media');
	}

	/*
	 * 轮播列表
	 */
	public function banner_list() {

		$list = array();
		$list = $this->get_by_type(C('MEDIA_BANNER_TYPE'));
		$this->assign('list', $list);
		$this->display();
	}

	/*
	 * 添加轮播
	 */
	public function banner_add() {
		if(I('action') == 'dosubmit') {

			if( ! isset($_FILES['pic_one']) OR empty($_FILES['pic_one']['tmp_name']) ) {
				$this->error('请上传图片资源');
			}

			//获取图片上传后路径
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
    		$upload->savePath  =     ''; // 设置附件上传（子）目录
    		$upload->saveRule  =     'time';
    		$info = $upload->upload();

    		if(empty($info)) {
    			$this->error('上传失败！请检查图片大小!');
    		}

    		$url_pic = '';
    		foreach($info as $file) {
    			$url_pic = '/uploads/'.$file['savepath'].$file['savename'];
    		}

    		$insert = array('type' => C('MEDIA_BANNER_TYPE'), 'url_pic' => $url_pic, 'url_target' => I('url_target'), 'sort' => I('order') , 'create_time' => time());
    		if($this->media->add($insert)) {
    			$this->redirect('banner_list');
    		} else {
    			$this->error('数据保存失败!');
    		}

		} else{

			$this->display();
		}
	}

	/*
	 * 删除轮播
	 */
	public function banner_del() {
		$id = I('id');
		if($id <= 0) $this->error('参数错误！');

		$media = $this->media->where('id ='.$id)->find();
		if(empty($media)) $this->error('数据不存在!');

		if($this->media->where('id ='.$id)->delete()) {

			$path = './Public'.$media['url_pic'];
			if(file_exists($path)) {
				@unlink($path);
			}
			$this->redirect('banner_list');
		} else {
			$this->error('删除失败！');
		}
	}

	/*
	 * 微信二维码（只有一条记录）
	 */
	public function weixin() {

		$one = $this->media->where('type ='.C('MEDIA_WEIXIN_TYPE'))->select();
		$one = count($one) > 0 ? reset($one) : array();

		if(I('action') == 'dosubmit') {

			if( ! isset($_FILES['pic_one']) OR empty($_FILES['pic_one']['tmp_name']) ) {
				$this->error('请上传图片资源');
			}

			//获取图片上传后路径
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
    		$upload->savePath  =     ''; // 设置附件上传（子）目录
    		$upload->saveRule  =     'time';
    		$info = $upload->upload();

    		if(empty($info)) {
    			$this->error('上传失败！请检查图片大小!');
    		}

    		$url_pic = '';
    		foreach($info as $file) {
    			$url_pic = '/uploads/'.$file['savepath'].$file['savename'];
    		}

    		//如果本来已经存在图片，删除
    		if( ! empty($one)) {
    			$this->media->where('id='.$one['id'])->update(array('url_pic' => $url_pic));
    			if(file_exists('./Public'.$one['url_pic'])) @unlink('./Public'.$one['url_pic']);
    		} else {
    			$insert = array('type' => C('MEDIA_WEIXIN_TYPE'), 'url_pic' => $url_pic, 'create_time' => time());
    			$this->media->add($insert);
    		}
    		$this->redirect('weixin');
		}

		$this->assign('list', $one);
		$this->display();
	}

	/*
	 * 获取列表
	 */
	private function get_by_type($type, $limit = 0) {
		if($limit == 0) {
			$result = $this->media->where('type ='.$type)->select();
		} else {
			$result = $this->media->where('type ='.$type)->limit( ( int )$limit)->select();
		}
		return $result;
	}
}