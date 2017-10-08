<?php
namespace Home\Controller;
use Think\Controller;
use Common\Controller\BaseController;
use Think\Base;

//作为分发器使用
class MenuController extends Controller {

    public function menu($id) {
        $menu_list = M('column')->where(array('column_open' => 1))->field('c_id,column_name,column_enname,column_type,column_leftid')->order('column_order')->select();
        if( ! empty($menu_list)) {
            $tmp = [];
            foreach ($menu_list as $m) {
                $tmp[$m['c_id']] = $m;
            }
            $menu_list = $tmp;
            unset($tmp);
        }

        if( ! isset($menu_list[$id])) {
            $this->error('菜单不存在！');
        }

        $m_id = $id;
        $m_type = $menu_list[$id]['column_type'];
        //找到它的父类
        if($menu_list[$id]['column_leftid'] > 0) {
            $m_id = $menu_list[$id]['column_leftid'];
            $m_type = $menu_list[$menu_list[$id]['column_leftid']]['column_type'];
        }

        //InfoController处理单页和列表
        //ContactController处理联系我们
        //TeamController处理云秀团队
        switch ($m_id) {
            case C('MENU_ABOUT'):
            case C('MENU_NEWS'):
            case C('MENU_SERVICES'):
                $this->redirect('Info/index/id/'.$id);
                break;
            case C('MENU_CONTACT'):
                $this->redirect('Contact/index/id/'.$id);
                break;
            case C('MENU_TEAM'):
                $this->redirect('Team/index/id/'.$id);
                break;
            default :
                //余下可按类型分发
                $this->error('不支持的菜单！');
                break;
        }
    }

}