<?php

	function get_avatar_name(){
		return 'temp';
	}
	
    function sendMail($to, $title, $content) {
     
        Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"尊敬的客户");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = ""; //邮件正文不支持HTML的备用显示
        return($mail->Send());
    }

    function subtext($text, $length)
    {
    	if(mb_strlen($text, 'utf8') > $length)
        {
    		return mb_substr($text, 0, $length, 'utf8').'...';
        }
    	return $text;
    }
    
/**************************数据备份操作*****************************/

    /**
    * 格式化字节大小
    * @param  number $size      字节数
    * @param  string $delimiter 数字和单位分隔符
    * @return string            格式化后的带单位的大小
    * @author slackck <876902658@qq.com>
    */
    function format_bytes($size, $delimiter = '') {
    $units = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB');
    		for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    		return round($size, 2) . $delimiter . $units[$i];
    }
    
/******************************保存图片到本地***********************************/
    function getImage($url,$save_dir='',$filename='',$type=0){
    	if(trim($url)==''){
    		return array('file_name'=>'','save_path'=>'','error'=>1);
    	}
    	if(trim($save_dir)==''){
    		$save_dir='./';
    	}
    	if(trim($filename)==''){//保存文件名
    		$ext=strrchr($url,'.');
    		if($ext!='.gif'&&$ext!='.jpg'&&$ext!='.png'&&$ext!='.jpeg'){
    			return array('file_name'=>'','save_path'=>'','error'=>3);
    		}
    		$filename=time().rand(0,10000).$ext;
    	}
    	if(0!==strrpos($save_dir,'/')){
    		$save_dir.='/';
    	}
    	//创建保存目录
    	if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
    		return array('file_name'=>'','save_path'=>'','error'=>5);
    	}
    	//获取远程文件所采用的方法
    	if($type){
    		$ch=curl_init();
    		$timeout=5;
    		curl_setopt($ch,CURLOPT_URL,$url);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    		$img=curl_exec($ch);
    		curl_close($ch);
    	}else{
    		ob_start();
    		readfile($url);
    		$img=ob_get_contents();
    		ob_end_clean();
    	}
    	//$size=strlen($img);
    	//文件大小
    	$fp2=@fopen($save_dir.$filename,'a');
    	fwrite($fp2,$img);
    	fclose($fp2);
    	unset($img,$url);
    	return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
    }

    /**
     * 文件大小格式化
     * @param integer $size 初始文件大小，单位为byte
     * @return array 格式化后的文件大小和单位数组，单位为byte、KB、MB、GB、TB
     */
    function file_size_format($size = 0, $dec = 2) {
        $unit = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        $result['size'] = round($size, $dec);
        $result['unit'] = $unit[$pos];
        return $result['size'].$result['unit'];
    }

    /**
     * 生成签名
     * @param  array   $params     请求参数
     * @param  string  $app_secret APP SECRET
     * @return string             签名
     */
    function generateSign($params, $app_secret)
    {
        ksort($params);
        $stringToBeSigned = $app_secret;
        foreach ($params as $k => $v)
        {
            $stringToBeSigned .= "$k$v";
        }
        unset($params);
        $stringToBeSigned .= $app_secret;
        return strtoupper(md5($stringToBeSigned));
    }

    /**
     * 请求接口
     * @return string             结果数组
     */
    if (! function_exists('curl_send'))
    {
        function curl_send($url, $params = array(), $isPost = FALSE, $options = NULL, $is_formated = FALSE)
        {
            //加入访问令牌,生成签名
            $params['app_key']    = C('APP_KEY');
            $params['app_secret'] = C('APP_SECRECT');
            $params['method']     = $isPost ? 'POST' : 'GET';
            $params['sign']       = generateSign($params , $params['app_secret']);

            $ch = curl_init();
            $initOptions = array(
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_NOSIGNAL => TRUE,
                CURLOPT_HEADER => FALSE,
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_TIMEOUT => 2,
            );
            if(is_array($options))
            {
                foreach ($options as $key => $val)
                {
                    $initOptions[$key] = $val;
                }
            }

            $url_arr = parse_url( $url );
            $request_method = $isPost ? 'POST' : 'GET';
            if( isset( $url_arr['query'] ) && strlen( $url_arr['query'] ) > 1 )
            {
                $url = $url . '&method=' . $request_method;
            } else {
              $url = $url . '?method=' . $request_method;
            }    

            $fields = http_build_query($params);
            if($isPost)
            {
                $initOptions[CURLOPT_URL] = $url;
                $initOptions[CURLOPT_POST] = TRUE;
                $initOptions[CURLOPT_POSTFIELDS] = $fields;
            }
            else
            {
                if($fields) $url .= (strpos($url, '?') > 0) ? '&'.$fields : '?'.$fields;
                $initOptions[CURLOPT_URL] = $url;
            }

            curl_setopt_array($ch, $initOptions);

            $data = curl_exec($ch);

            if(curl_errno($ch) != 0)
            {
                $error = curl_error($ch);
                $curlInfo = curl_getinfo($ch);
                $data['error'] = 1;
                $data['msg'] = $curlInfo;
            }
            else
            {
                $data = json_decode($data, TRUE);
            }

            curl_close($ch);
            
            return $data;
        }
    }

    /**
     * 检查Email格或是否正确
     * @param  String $email [description]
     * @return Boolean        [description]
     */
    if (! function_exists('check_email_format'))
     {
        function check_email_format($email)
        {
            return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
        }
    }

    /**
     * *检查用户是否合法
     * @param  String $username [description]
     * @return Boolean          [description]
     */
    if (! function_exists('check_username_format'))
    {
        function check_username_format($username)
        {
            $guestexp = '\xA1\xA1|\xAC\xA3|^Guest|^\xD3\xCE\xBF\xCD|\xB9\x43\xAB\xC8';
            $len = dstrlen($username);
            if ($len > 15 || $len < 6 || preg_match("/\s+|^c:\\con\\con|[%,\*\"\s\<\>\&]|$guestexp/is", $username))
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    /**
     * *生成验证码
     * @return Boolean          [description]
     */
    if (! function_exists('verfity'))
    {
        function verfity()
        {
            $length=4;
            if (isset($_GET['length']) && intval($_GET['length'])){
                $length = intval($_GET['length']);
            }
            
            //设置验证码字符库
            $code_set="";
            if(isset($_GET['charset'])){
                $code_set= trim($_GET['charset']);
            }
            
            $use_noise=1;
            if(isset($_GET['use_noise'])){
                $use_noise= intval($_GET['use_noise']);
            }
            
            $use_curve=1;
            if(isset($_GET['use_curve'])){
                $use_curve= intval($_GET['use_curve']);
            }
            
            $font_size=25;
            if (isset($_GET['font_size']) && intval($_GET['font_size'])){
                $font_size = intval($_GET['font_size']);
            }
            
            $width=0;
            if (isset($_GET['width']) && intval($_GET['width'])){
                $width = intval($_GET['width']);
            }
            
            $height=0;
                
            if (isset($_GET['height']) && intval($_GET['height'])){
                $height = intval($_GET['height']);
            }

            //TODO ADD Backgroud param!
            
            $config = array(
                'codeSet'   =>  !empty($code_set)?$code_set:"2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY",             // 验证码字符集合
                'expire'    =>  1800,            // 验证码过期时间（s）
                'useImgBg'  =>  false,           // 使用背景图片 
                'fontSize'  =>  !empty($font_size)?$font_size:25,              // 验证码字体大小(px)
                'useCurve'  =>  $use_curve===0?false:true,           // 是否画混淆曲线
                'useNoise'  =>  $use_noise===0?false:true,            // 是否添加杂点 
                'imageH'    =>  $height,               // 验证码图片高度
                'imageW'    =>  $width,               // 验证码图片宽度
                'length'    =>  !empty($length)?$length:4,               // 验证码位数
                'bg'        =>  array(243, 251, 254),  // 背景颜色
                'reset'     =>  true,           // 验证成功后是否重置
            );
            $Verify = new \Think\Verify($config);
            $Verify->entry();
        }
    }

    if (! function_exists('dstrlen'))
    {
        /**
         * 计算字符串的长度
         * @param  String $str     [description]
         * @param  String $charset [description]
         * @return Boolean         [description]
         */
        function dstrlen($str, $charset = 'utf-8')
        {
            if (strtolower($charset) != 'utf-8')
            {
                return strlen($str);
            }

            $count = 0;       
            for ($i = 0; $i < strlen($str); $i++)
            {
                $value = ord($str[$i]);
                if ($value > 127)
                {
                    $count++;
                    if($value >= 192 && $value <= 223) $i++;
                    elseif($value >= 224 && $value <= 239) $i = $i + 2;
                    elseif($value >= 240 && $value <= 247) $i = $i + 3;
                    }
                    $count++;
            }

            return $count;
        }
    }


    if ( ! function_exists('real_ip'))
    {
        function real_ip()
        {
            static $realip = NULL;

            if ($realip !== NULL)
            {
                return $realip;
            }

            if (isset($_SERVER))
            {
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                {
                    $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                    /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                    foreach ($arr AS $ip)
                    {
                        $ip = trim($ip);

                        if ($ip != 'unknown')
                        {
                            $realip = $ip;

                            break;
                        }
                    }
                }
                elseif (isset($_SERVER['HTTP_CLIENT_IP']))
                {
                    $realip = $_SERVER['HTTP_CLIENT_IP'];
                }
                else
                {
                    if (isset($_SERVER['REMOTE_ADDR']))
                    {
                        $realip = $_SERVER['REMOTE_ADDR'];
                    }
                    else
                    {
                        $realip = '0.0.0.0';
                    }
                }
            }
            else
            {
                if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                    $realip = getenv('HTTP_X_FORWARDED_FOR');
                }
                elseif (getenv('HTTP_CLIENT_IP'))
                {
                    $realip = getenv('HTTP_CLIENT_IP');
                }
                else
                {
                    $realip = getenv('REMOTE_ADDR');
                }
            }

            preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
            $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

            return $realip;
        }
    }

    if (! function_exists('get_salt'))
    {
        /**
         * 获取加盐字符串
         * @return [type] [description]
         */
        function get_salt()
        {
            return substr(uniqid(rand()), -6);
        }
    }

?>