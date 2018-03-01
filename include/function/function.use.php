<?php
	//安全过滤
	function inject_check($str) {
		$check = preg_match('/select|insert|update|delete|\'|\\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i',$str); 

		if($check){
			echo "<script>alert('输入内容非法!');location.href='index.php'</script>";
			exit();
		}else{
			return $str;
		}
	}

	//创建文件夹
	function create_folders($dir){
		return is_dir($dir) or (create_folders(dirname($dir)) and mkdir($dir, 0777));
	}

	/*
		单附件上传
		$oldpath - 老附件
		$path - 上传位置
		$width - 图片宽度
		$height - 图片高度
		$attchment - 控件名
	*/
	function upload($oldpath,$path,$width,$height,$attchment){

		global $UPLOAD;

		$atc = $attchment == null ? 'attchment' : $attchment;

		$uploadsize = $_FILES[$atc]['size']/1024/1024;

		if($uploadsize > get_cfg_var('post_max_size')){
			echo "<script> alert('附件过大！超出服务器允许上传限制！');history.back();</script>";
		}

		if(!empty($oldpath)){//删除老附件
			@unlink($UPLOAD.$oldpath);
		}

		$link = date('Ym');
		$type = strtolower(substr($_FILES[$atc]['name'],-3)); 
						
		$post_paths = date('Ymd').rand(0,999).'.'.$type; 

		if(!empty($path)){//新路径
			$picpath = $path;
			$post_path = $post_paths;
		}else{
			$picpath = $UPLOAD.'image/'.date('Ymd');
			$post_path = 'image/'.date('Ymd').'/'.$post_paths;
		}

		create_folders($picpath);

		$files = $picpath.'/'.$post_paths;
		
		move_uploaded_file($_FILES[$atc]['tmp_name'],$files);  
		if($type == 'gif' || $type == 'jpg' || $type == 'jpeg' || $type == 'png'){

			if(empty($width)){
				$width = 600;
			}

			if(empty($height)){
				$height = 600;
			}

			$obj = new Img();
			$obj->Img_BigToSamll($files,$width,$height,$files,0);

		}

		return $post_path;

	}

	function Get_curls($url){
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($ch);
	    curl_close($ch);
	    return $output;
	} 

	/*
	* $type - 类型
	* $txt  - 提示文字
	* $url  - 网址
	*/
	function jcript($type,$txt=null,$url=null){

		$js = '<script>';
		
		switch($type){

			case 'href':
				$js .= 'window.location.href="'.$url.'";'; 
				break;

			case 'all':
				$js .= 'Alert("'.$txt.'","'.$url.'");'; 
				break;

			case 'back':
				$js .= 'Alert("'.$txt.'");history.back();'; 
				break;

		}

		$js .= "</script>";

		echo $js;
	
	}

	/*
	* 清除HTML标签及其中的图片
	* 方法 clearHtml
	* 参数 $str
	* 注:Smarty模版专用
	*/
	function clearHtml($params){

		extract($params);//smart模版专用

		//此段可省smarty模版有专用去除HTML标签
		//$str = preg_replace('/<[^>]+>/','',$str);

		$str = preg_replace('/<img[^>]+>/i','',$str);

		return $str;

	} 

	//过滤非法字 *
	function replaceing($str){
	
		$arr = array("/靠/","/fuck/","/bitch/i","/falundafa/","/falun/i","/a片/","/A片/","/性爱/","/江泽民/","/操你妈/","/三级片/","/台独/","/妈的/","/upfile/","/images/","/insert/","/select/","/delete/","/update/","/tmd/","/尼玛/","/你妈/","/他妈/","/她妈/","/它妈/","/艹/","/草/","/jb/","/鸡巴/","/共产党/","/反共/","/法西斯/","/邪教/","/法轮功/","/滚犊子/","/傻子/","/傻逼/","/sb/");
		$string = preg_replace($arr,"*",$str);
		return $string;
		
	}

	function getIP(){ 
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
		$ip = getenv("REMOTE_ADDR"); 
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
		else 
		$ip = "unknown"; 
		return($ip); 
	}

?>