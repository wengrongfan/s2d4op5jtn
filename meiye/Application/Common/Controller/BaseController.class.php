<?php
namespace Common\Controller;
use Think\Controller;
use Think\Base;
use Think\Model;

//前台公共控制器
class BaseController extends CommonController {
	protected $sys = array('sys_name' , 'sys_title' , 'sys_key' , 'sys_des', 'mobile', 'phone', 'mail', 'address');
	protected function _initialize()
	{
		//站点信息
		$web_info = [];
		$sys = M('sys')->where(array('sys_id' => 1))->find();
		if(is_array($sys) && ! empty($sys))
		{
			foreach ($sys as $key => $value)
			{
				if($key != 'sys_base' && in_array($key , $this->sys))
				{
					$web_info[$key] = $value;
				}
				else
				{
					$sys_base = json_decode($value, true);
					if( ! empty($sys_base))
					{
						foreach ($sys_base as $key => $value)
						{
							if(in_array($key , $this->sys))
							{
								$web_info[$key] = $value;
							}
						}
					}
				}
			}
		}

		//外链(限制15条)、没有外链的
		//$link = M('plug_link')->where(array('plug_link_open' => 1))->limit(15)->select();
		//$this->assign('link' , $link);
		$this->assign('web_info' , $web_info);

		//微信二维码(输出时要判断是否空)
		$winxin_code = '';
		$media = M('media')->where(array('type' => C('MEDIA_WEIXIN_TYPE')))->order('sort')->find();
		if( ! empty($media)) {
			$winxin_code = $media['url_pic'];
		}
		$this->assign('winxin_code' , $winxin_code);

		//菜单
		$tree = [];
		$menu_list = M('column')->where(array('column_open' => 1))->field('c_id,column_name,column_enname,column_type,column_leftid')->order('column_order')->select();
		if( ! empty($menu_list)) {
			$tmp = [];
			foreach ($menu_list as $m) {
				$tmp[$m['c_id']] = array(
					'id' => $m['c_id'],
					'name' => $m['column_name'],
					'enname' => $m['column_enname'],
					'type' => $m['column_type'],
					'pId' => $m['column_leftid']
					);

				if($m['column_leftid'] > 0 && isset($tmp[$m['column_leftid']])) {

					$tmp[$m['column_leftid']]['children'][$m['c_id']] = &$tmp[$m['c_id']];
					unset($tmp[$m['c_id']]);

				} else {

					$tree[$m['c_id']] = &$tmp[$m['c_id']];

				}
			}
			unset($tmp);
		}
		$this->assign('menu_tree' , $tree);
	}

	//banner信息，需要时才调用
	public function banner() {

		$media_list = M('media')->where(array('type' => C('MEDIA_BANNER_TYPE')))->order('sort')->select();
		$this->assign('banner_list' , $media_list);
	}
}