<?php
namespace Admin\Controller;
use Think\Controller;
use LT\ThinkSDK\ThinkOauth;
use Event\TypeEvent;

class LoginController extends Controller {
	//登入页面
    public function login(){
		$this->display();
    }

    //验证码
    public function verfity()
    {
    	verfity();
    }

    //登陆验证
	public function runlogin(){
		if (!IS_AJAX){
			$this->error("提交方式错误！",U('login'),0);
		}else{
			$admin_username=I('admin_username');
			$admin_pwd=md5(I('admin_pwd'));
			$verfity_code = I('verfity');
			$Verify = new \Think\Verify();
			
			$admin=M('admin')->where(array('admin_username'=>$admin_username,'admin_pwd'=>$admin_pwd))->find();
				if (!$admin||$admin_pwd!==$admin['admin_pwd'])
				{
					$this->error('用户名或者密码错误，重新输入',U('login'),0);
				}
				elseif($Verify->check($verfity_code) != true)
				{
					$this->error('验证码错误!',U('login'),0);
				}
				else
				{
					//登录后更新数据库，登录IP，登录次数,登录时间
					$data=array(
							'admin_ip'=>get_client_ip(),
					);
					M('admin')->where(array('admin_username'=>$admin_username))->setInc('admin_hits',1);
					M('admin')->save($data);
					session('aid',$admin['admin_id']);
					session('admin_username',$admin['admin_username']);
					session('admin_realname',$admin['admin_realname']);
					$this->success('恭喜您，登陆成功',U('Index/index'),1);
				}
		}
	}

/*
 * 退出登录
 */
	public function logout(){
		session(null);
		$this->redirect('Login/login');
	}
	
/*
 * 邮件发送类
 */
	public function runemail(){
		$emailsys=M('sys')->where(array('sys_id'=>1))->find();
	    $config = array(
			'MAIL_FROM'=>$emailsys['email_name'],
			'MAIL_HOST'=>$emailsys['email_smtpname'],
			'MAIL_USERNAME'=>$emailsys['email_emname'],
			'MAIL_FROMNAME'=>$emailsys['email_rename'],
			'MAIL_PASSWORD'=>$emailsys['email_pwd'],
		);
	    if ($emailsys['email_open']==1){//邮件发送开关
	    	$config['MAIL_SMTPAUTH'] = TRUE ;
	    }else{
	    	$config['MAIL_SMTPAUTH'] = FALSE ;
	    }
    	C($config);
    	$callurl=C('DB_CALLURL');
		$admin=M('admin')->where(array('admin_email'=>I('email')))->find();
		
		if(!$admin){
			$this->error('邮件不存在，请重新输入',0,0);
		}
		$oldnum=rand(10000,99999);//获取一串随机数
		$num=md5($oldnum);//对随机数进行加密后传递
		$emailpwd=M('admin')->where(array('admin_email'=>I('email')))->setField('admin_mdemail',$num);//更新数据库
		$content="尊敬的用户，您好：<br>您当前的操作为找回密码，请点击以下链接重新设置密码<br><a href=$callurl/index.php/Admin/Login/checkpwd/emailpwd/$num.html>$callurl/index.php/Admin/Login/checkpwd/emailpwd/$num.html</a>";
		if(SendMail($_POST['email'],'找回密码服务',$content))
			$this->success('邮件发送成功！，打开邮件重新设置密码',1,1);
		else
			$this->error('邮件发送失败',0,0);
		}
	
	//打开修改密码页面
	public function checkpwd(){
		$admin_mdemail=I('emailpwd');
		if (!$admin_mdemail){
			$this->error('参数错误',U('login'),0);
		}else{
			$this->assign('admin_mdemail',$admin_mdemail);
			$this->display();
		}
	}

	//修改密码操作
	public function runcheckpwd(){
		if (!IS_AJAX){
			$this->error("提交方式错误！",0,0);
		}else{
		$admin_mdemail=I('admin_mdemail');//获取加密过后的随机值
		$admin_pwd=I('admin_pwd','','md5');//获取新密码，并且加密
		$checkadmin=M('admin')->where(array('admin_mdemail'=>$admin_mdemail))->find();//验证用户是否存在
			if(!$checkadmin){
				$this->error('邮箱不存在，请重新输入',0,0);
			}else{
				$admin=M('admin')->where(array('admin_mdemail'=>$admin_mdemail))->setField('admin_pwd',$admin_pwd);
				$this->success('恭喜您，密码修改成功',U('login'),1);
			}
		}

	}

/*
 * 第三方登录
 */
	public function bing_login($type = null) {
        empty($type) && $this->error('参数错误');
        $sns = ThinkOauth::getInstance($type);
        redirect($sns->getRequestCodeURL());
	}

	//授权回调地址
	public function callback($type = null, $code = null)
	{

		(empty($type) || empty($code)) && $this->error('参数错误');
	
		//加载ThinkOauth类并实例化一个对象
		$sns = ThinkOauth::getInstance($type);

		//腾讯微博需传递的额外参数
		$extend = null;
		if ($type == 'tencent') {
			$extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
		}
	
		//请妥善保管这里获取到的Token信息，方便以后API调用
		//调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
		//$qq = ThinkOauth::getInstance('qq', $token);
		$token = $sns->getAccessToken($code,$extend);
		//获取当前登录用户信息
		if (is_array($token)) {
			$user_info = A('Type','Event')->$type($token);
			if (!$user_info){//登录失败
				$this->error('第三方登录失败，请重新登录',U('login'),1);
			}else{
				
			}
		}
	}
	

}