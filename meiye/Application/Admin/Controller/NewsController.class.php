<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class NewsController extends AuthController {
	
/************************************************文章管理**************************************************/
	//文章列表
    public function news_list(){
    	$news_list=D('News');
    	$keytype=I('keytype',news_title);
    	$key=I('key');
    	$opentype_check=I('opentype_check','');
    	$diyflag=I('diyflag','');
    	//查询：时间格式过滤
    	$sldate=I('reservation','');//获取格式 2015-11-12 - 2015-11-18
    	$arr = explode(" - ",$sldate);//转换成数组
    	$arrdateone=strtotime($arr[0]);
    	$arrdatetwo=strtotime($arr[1].' 23:55:55');
    	//map架构查询条件数组
    	$map['news_back']= 0;
    	$map[$keytype]= array('like',"%".$key."%");
    	if ($opentype_check!=''){
    	$map['news_open']= array('eq',$opentype_check);
    	}
    	$map['news_time'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
    	if ($diyflag){
    		$map[] ="FIND_IN_SET('$diyflag',news_flag)";
    	}
    	if ($_SESSION['aid']!=1){
    		$map['news_adminid']= array('eq',$_SESSION['aid']);
    	}
    	//p($map);die;
    	$count= $news_list->where($map)->count();// 查询满足要求的总记录数
    	$Page= new \Think\Page($count,C('DB_PAGENUM'));// 实例化分页类 传入总记录数和每页显示的记录数
    	$show= $Page->show();// 分页显示输出
    	$news=$news_list->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('news_time desc')->relation(true)->select();
    	$diyflag_list=M('diyflag')->select();//文章属性数据

    	$this->assign('opentype_check',$opentype_check);
    	$this->assign('keytype',$keytype);
    	$this->assign('keyy',$key);
    	$this->assign('sldate',$sldate);
    	$this->assign('diyflag_check',$diyflag);
    	$this->assign('diyflag',$diyflag_list);
    	$this->assign('news',$news);
    	$this->assign('page',$show);
		$this->display();
    }
    
    //添加文章
    public function news_listadd(){
    	$column=M('column');
		$diyflag=M('diyflag');
    	$nav = new \Org\Util\Leftnav;
    	$column_next=$column->where('column_type <> 5 and column_type <> 2')-> order('column_order') -> select();
		$diyflag=$diyflag->select();
    	$arr = $nav::column($column_next);
    	$source=M('source')->select();
    	$this->assign('source',$source);
    	$this->assign('column',$arr);
		$this->assign('diyflag',$diyflag);
    	$this->display();
    }
    
    public function news_runadd(){
    	if (!IS_AJAX){
    		$this->error('提交方式不正确',U('news_list'),0);
    	}else {
    		$news=M('news');
    			//单图上传控制
    			if($pop=$_FILES['pic_one']['name'][0] || $popp=$_FILES['pic_all']['name'][0]){ //images 是你上传的名称
    				//获取图片上传后路径
    				$upload = new \Think\Upload();// 实例化上传类
    				$upload->maxSize   =     3145728 ;// 设置附件上传大小
    				$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    				$upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
    				$upload->savePath  =     ''; // 设置附件上传（子）目录
    				$upload->saveRule  =     'time';
    				$info   =   $upload->upload();
    				$picall_url="";
    				if($info) {
    					foreach($info as $file){
    						if ($file['key']=='pic_one'){//单图路径数组
    							$img_url='/uploads/'.$file[savepath].$file[savename];//如果上传成功则完成路径拼接
    						}else{
    							$picall='/uploads/'.$file[savepath].$file[savename];//如果上传成功则完成路径拼接
    							$picall_url=$picall.','.$picall_url;
    						}
    					}
    				}else{
    					$this->error($upload->getError());//否则就是上传错误，显示错误原因
    				}
    			}
    			 
    			//获取文章属性
    			$news_flag=I('news_flag');
    			$flag=array();
    			foreach ($news_flag as $v){
    				$flag[]=$v[0];
    			}
    			$flagdata=implode(',',$flag);

    			$sl_data=array(
    					'news_title'=>I('news_title'),
    					'news_titleshort'=>I('news_titleshort'),
    					'news_columnid'=>I('news_columnid'),
    					'news_flag'=>$flagdata,
    					'news_zaddress'=>I('news_zaddress'),
    					'news_key'=>I('news_key'),
    					'news_tag'=>I('news_key'),
    					'news_source'=>I('news_source'),
    					'news_pic_type'=>I('news_pic_type'),
    					'news_pic_content'=>I('news_pic_content'),
    					'news_pic_allurl'=>$picall_url,//多图路径
    					'news_adminid'=>$_SESSION['aid'],
    					
    					'news_img'=>$img_url,
    					 
    					'news_open'=>I('news_open'),
    					'news_scontent'=>I('news_scontent'),
    					'news_auto'=>$_SESSION['admin_realname'],
    					'news_time'=>time(),
    					'news_hits'=>200,
    			);
    			 
    			$res=$news->add($sl_data);//保存并且获取ID
    			$sl_content=array(
    					'news_content_nid'=>$res,
    					'news_content_body'=>I('news_content'),
    			);
    			M('news_content')->field('news_content_nid,news_content_body')->add($sl_content);
    			$this->success('文章添加成功,返回列表页',U('news_list'),1);
    		}

    }
    

    public function news_runedit(){
    	if (!IS_AJAX){
    		$this->error('提交方式不正确',U('news_list'),0);
    	}else{
    		$news=M('news');
    		if (!$news->autoCheckToken($_POST)){
    			$this->error('表单令牌错误',0,0);
    		}else{
    			//获取图片上传后路径
    			$checkpic=I('checkpic');
    			$oldcheckpic=I('oldcheckpic');
    			
    			$pic_oldlist=I('pic_oldlist');//老多图字符串
    			
    			if($pop=$_FILES['pic_one']['name'][0] || $popp=$_FILES['pic_all']['name'][0]){ //images 是你上传的名称
    				$upload = new \Think\Upload();// 实例化上传类
    				$upload->maxSize   =     3145728 ;// 设置附件上传大小
    				$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    				$upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
    				$upload->savePath  =     ''; // 设置附件上传（子）目录
    				$upload->saveRule  =     'time';
    				$info   =   $upload->upload();
    				$picall_url="";
    				if($info) {
    					foreach($info as $file){//获取全部的上传数据
    						if ($file['key']=='pic_one'){//单图路径数组，通过key来判断是单图还是多图
    							$img_url='/uploads/'.$file[savepath].$file[savename];//如果上传成功则完成路径拼接
    						}else{//多图上传路径
    							$picall='/uploads/'.$file[savepath].$file[savename];//如果上传成功则完成路径拼接
    							$picall_url=$picall.','.$picall_url;//循环拼凑成字符串
    						}
    					}
    				}else{
    					$this->error($upload->getError());//否则就是上传错误，显示错误原因
    				}
    				$picall_list=$pic_oldlist.$picall_url;//整合新的多图字符串以及老的字符串
    			}else{
    				$picall_list=$pic_oldlist;//整合新的多图字符串以及老的字符串
    			}
    			 
    			$sll_data=array(
    					'n_id'=>I('n_id'),
    			);
    			
    			//获取文章属性
    			$news_flag=I('news_flag');
    			$flag=array();
    			foreach ($news_flag as $v){
    				$flag[]=$v[0];
    			}
    			$flagdata=implode(',',$flag);
    			 
    			
    			$sl_data=array(
    					'n_id'=>I('n_id'),
    					'news_title'=>I('news_title'),
    					'news_titleshort'=>I('news_titleshort'),
    					'news_columnid'=>I('news_columnid'),
    					'news_flag'=>$flagdata,
    					'news_zaddress'=>I('news_zaddress'),
    					'news_key'=>I('news_key'),
    					'news_tag'=>I('news_key'),
    					'news_source'=>I('news_source'),
    					'news_pic_type'=>I('news_pic_type'),
    					'news_pic_content'=>I('news_pic_content'),
    					'news_open'=>I('news_open'),
    					'news_scontent'=>I('news_scontent'),
    			);
    			if ($checkpic!=$oldcheckpic){
    				$sl_data['news_img']=$img_url;
    			}
    			$sl_data['news_pic_allurl']=$picall_list;
    			$news->save($sl_data);
    			 
    			$sl_content=array(
    					'news_content_id'=>I('news_content_id'),
    					'news_content_body'=>I('news_content'),
    			);
    			M('news_content')->save($sl_content);
    			$this->success('文章修改成功,返回列表页',U('news_list'),1);
    			
    			
    		}
    	}

    }
    
    public function news_list_del(){
    	$news_list=M('news');
    	$p=I('p');
    	$n_id=I('n_id');
    	$check_nid=$news_list->where(array('n_id'=>I('n_id')))->find();
    	if (empty($check_nid)){
    		$this->error('参数不正确',0,0);
    	}else {
    		$check_admin_nid=$news_list->where(array('n_id'=>I('n_id'),'news_adminid'=>$_SESSION['aid']))->find();
    		if (empty($check_admin_nid) && $_SESSION['aid']!=1){
    			$this->error('你没有删除该文章权限',0,0);
    		}else {
    			$news_list->where(array('n_id'=>I('n_id')))->setField('news_back',1);//转入回收站
    			$this->redirect('news_list', array('p' => $p));
    		}
    	}
    }

    public function news_back_open(){
    	$news_list=M('news');
    	$p=I('p');
    	$n_id=I('n_id');
    	$check_nid=$news_list->where(array('n_id'=>I('n_id')))->find();
    	if (empty($check_nid)){
    		$this->error('参数不正确',0,0);
    	}else {
    		$check_admin_nid=$news_list->where(array('n_id'=>I('n_id'),'news_adminid'=>$_SESSION['aid']))->find();
    		if (empty($check_admin_nid) && $_SESSION['aid']!=1){
    			$this->error('你没有还原该文章权限',0,0);
    		}else {
		    	$news_list->where(array('n_id'=>I('n_id')))->setField('news_back',0);//转入回收站
		    	$this->redirect('news_back', array('p' => $p));
    		}
    	}

    }
    
    //回收站
    public function news_back(){
    	$news_list=D('News');
    	$keytype=I('keytype',news_title);
    	$key=I('key');
    	$opentype_check=I('opentype_check','');
    	$diyflag=I('diyflag','');
    	//查询：时间格式过滤
    	$sldate=I('reservation','');//获取格式 2015-11-12 - 2015-11-18
    	$arr = explode(" - ",$sldate);//转换成数组
    	$arrdateone=strtotime($arr[0]);
    	$arrdatetwo=strtotime($arr[1].' 23:55:55');
    	//map架构查询条件数组
    	$map['news_back']= 1;
    	$map[$keytype]= array('like',"%".$key."%");
    	if ($opentype_check!=''){
    	$map['news_open']= array('eq',$opentype_check);
    	}
    	$map['news_time'] = array(array('egt',$arrdateone),array('elt',$arrdatetwo),'AND');
    	if ($diyflag){
    		$map[] ="FIND_IN_SET('$diyflag',news_flag)";
    	}
    	if ($_SESSION['aid']!=1){
    		$map['news_adminid']= array('eq',$_SESSION['aid']);
    	}
    	//p($map);die;
    	$count= $news_list->where($map)->count();// 查询满足要求的总记录数
    	$Page= new \Think\Page($count,C('DB_PAGENUM'));// 实例化分页类 传入总记录数和每页显示的记录数
    	$show= $Page->show();// 分页显示输出
    	$news=$news_list->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('news_time desc')->relation(true)->select();
    	$diyflag_list=M('diyflag')->select();//文章属性数据
    	$this->assign('opentype_check',$opentype_check);
    	$this->assign('keytype',$keytype);
    	$this->assign('keyy',$key);
    	$this->assign('sldate',$sldate);
    	$this->assign('diyflag_check',$diyflag);
    	$this->assign('diyflag',$diyflag_list);
    	$this->assign('news',$news);
    	$this->assign('page',$show);
		$this->display();
    	    }
    
    public function news_back_del(){
    	$news_list=M('news');
    	$p=I('p');
    	$n_id=I('n_id');
    	$check_nid=$news_list->where(array('n_id'=>I('n_id')))->find();
    	if (empty($check_nid)){
    		$this->error('参数不正确',0,0);
    	}else {
    		$check_admin_nid=$news_list->where(array('n_id'=>I('n_id'),'news_adminid'=>$_SESSION['aid']))->find();
    		if (empty($check_admin_nid) && $_SESSION['aid']!=1){
    			$this->error('你没有删除该文章权限',0,0);
    		}else {
	    		$news_back=$news_list->where(array('n_id'=>I('n_id')))->delete();
	    		$this->redirect('news_back', array('p' => $p));
    		}
    	}
    	
    	
    }

    public function news_back_alldel(){
    	$p = I('p');
    	$ids = I('n_id','',htmlspecialchars);
    	if(empty($ids)){
    		$this -> error("请选择删除文章");//判断是否选择了文章ID
    	}
    	$model = D('News');
    	if(is_array($ids)){//判断获取文章ID的形式是否数组
    		$where = 'n_id in('.implode(',',$ids).')';
    		$map = 'news_content_nid in('.implode(',',$ids).')';
    	}else{
    		$where = 'n_id='.$ids;
    		$map = 'news_content_nid='.$ids;
    	}
    	$model->where($where)->delete();
    	M('news_content')->where($map)->delete();
    	$this->success("成功把文章删除，不可还原！",U('news_back',array('p'=>$p)),1);
    }
    
    public function news_list_alldel(){
    	$p = I('p');
    	$ids = I('n_id','',htmlspecialchars);
    	if(empty($ids)){
    		$this -> error("请选择删除文章");//判断是否选择了文章ID
    	}
    	$model = D('news');
    	if(is_array($ids)){//判断获取文章ID的形式是否数组
    		$where = 'n_id in('.implode(',',$ids).')';
    	}else{
    		$where = 'n_id='.$ids;
    	}
    	M('news')->where($where)->setField('news_back',1);//转入回收站
    	$this->success("成功把文章移至回收站！",U('news_list',array('p'=>$p)),1);
    }
    

    
	public function news_list_edit(){
		$n_id = I('n_id','',htmlspecialchars);
		if (empty($n_id)){
			$this->error('参数错误',U('news_list'),0);
		}else{
			$news_list=M('news')->where(array('n_id'=>I('n_id')))->find();
			/*
			 * 多图字符串转换成数组
			 */
			$text = $news_list['news_pic_allurl'];
			$newstr = substr($text,0,strlen($text)-1);
			$pic_list = explode(",", $newstr);
			$this->assign('pic_list',$pic_list);
			
			$column=M('column');
			$diyflag=M('diyflag');
			$nav = new \Org\Util\Leftnav;
			$column_next=$column->where('column_type <> 5 and column_type <> 2')-> order('column_order') -> select();
			$diyflag=$diyflag->select();
			$arr = $nav::column($column_next);
			$source=M('source')->select();//来源
			$this->assign('source',$source);
			
			$news_content=M('news_content')->where(array('news_content_nid'=>$n_id))->find();
			$this->assign('news_content',$news_content);
			
			$this->assign('column',$arr);
			$this->assign('diyflag',$diyflag);
			$this->assign('news_list',$news_list);
			$this->display();
		}
	}
	
	public function news_list_state(){
		$news_list=M('news');
		$id=I('x');
		$status=$news_list->where(array('n_id'=>$id))->getField('news_open');//判断当前状态情况
		if($status==1){
			$statedata = array('news_open'=>0);
			$auth_group=$news_list->where(array('n_id'=>$id))->setField($statedata);
			$this->success('状态禁止',1,1);
		}else{
			$statedata = array('news_open'=>1);
			$auth_group=$news_list->where(array('n_id'=>$id))->setField($statedata);
			$this->success('状态开启',1,1);
		}
	}
	
/************************************************栏目管理**************************************************/
	//栏目管理
	public function news_column(){
		$column=M('column');
		$nav = new \Org\Util\Leftnav;
		$column=$column->order('column_order')->select();
		$arr = $nav::column($column);
		$this->assign('arr',$arr);
		$this->display();
	}
	
	//添加栏目
	public function news_columnadd(){
		$column_leftid=I('c_id',0);
		$this->assign('column_leftid',$column_leftid);
		$this->display();
	}
	
	public function runnews_columnadd(){
		if (!IS_AJAX){
			$this->error('提交方式不正确',U('News/news_column'),0);
		}else{
			$column=M('column');
			if (!$column->autoCheckToken($_POST)){
				$this->error('表单令牌错误',0,0);
			}else{
				$data=array(
						'column_name'=>I('column_name'),
						'column_enname'=>I('column_enname'),
						'column_type'=>I('column_type'),
						'column_leftid'=>I('column_leftid'),
						'column_address'=>I('column_address'),
						'column_open'=>I('column_open',0),
						'column_order'=>I('column_order'),
						'column_title'=>I('column_title'),
						'column_key'=>I('column_key'),
						'column_des'=>I('column_des'),
						'column_content'=>I('column_content'),
				);
				$column->field('column_name,column_name,column_type,column_leftid,column_address,column_open,column_order,column_title,column_key,column_des,column_content')->add($data);
				$this->success('栏目保存成功',U('News/news_column'),1);
			}
		}
	}
	
	//删除栏目
	public function news_columndel(){
		$column=M('column');
		$column->where(array('c_id'=>I('c_id')))->delete();
		$column->where(array('column_leftid'=>I('c_id')))->delete();
		$this->redirect('news_column');
	}

	

	public function leftnavorder(){
		if (!IS_AJAX){
			$this->error('提交方式不正确',0,0);
		}else{
			$column=M('column');
			foreach ($_POST as $id => $sort){
				$column->where(array('c_id' => $id ))->setField('column_order' , $sort);
			}
			$this->success('排序更新成功',U('news_column'),1);
		}
	}
	

	public function column_state(){
		$column=M('column');
		$id=I('x');
		$status=$column->where(array('c_id'=>$id))->getField('column_open');//判断当前状态情况
		if($status==1){
			$statedata = array('column_open'=>0);
			$auth_group=$column->where(array('c_id'=>$id))->setField($statedata);
			$this->success('状态禁止',1,1);
		}else{
			$statedata = array('column_open'=>1);
			$auth_group=$column->where(array('c_id'=>$id))->setField($statedata);
			$this->success('状态开启',1,1);
		}
	}
	
	public function news_columnedit(){
		$column=M('column')->where(array('c_id'=>I('c_id')))->find();
		$this->assign('column',$column);
		$this->display();
	}
	

	public function runnews_columnedit(){
		if (!IS_AJAX){
			$this->error('提交方式不正确',U('News/news_column'),0);
		}else{
			$column=M('column');
			if (!$column->autoCheckToken($_POST)){
				$this->error('表单令牌错误',0,0);
			}else{
				$data=array(
						'c_id'=>I('c_id'),
						'column_name'=>I('column_name'),
						'column_enname'=>I('column_enname'),
						'column_type'=>I('column_type'),
						'column_leftid'=>I('column_leftid'),
						'column_address'=>I('column_address'),
						'column_open'=>I('column_open',0),
						'column_order'=>I('column_order'),
						'column_title'=>I('column_title'),
						'column_key'=>I('column_key'),
						'column_des'=>I('column_des'),
						'column_content'=>I('column_content'),
				);
				$column->field('c_id,column_name,column_name,column_type,column_leftid,column_address,column_open,column_order,column_title,column_key,column_des,column_content')->save($data);
				$this->success('栏目保存成功',U('News/news_column'),1);
			}
		}
	}
	
}