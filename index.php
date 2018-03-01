<?php
include 'include/common.php';

//跳转授权
if(!isset($_COOKIE['openid'])){ 

	setcookie("openid", time(), time()+3600);

	//header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".getAppid()."&redirect_uri=http%3A%2F%2Frjh.aidimedia.cn%2Fgold-hand%2Fmain.php&response_type=code&scope=snsapi_base&state=123#wechat_redirect");


    exit();  
}

//用户

$user = $db->get_one("gh_user","WHERE userOpenId='{$_COOKIE['openid']}'");

if($user){

	//用户直接跳转抽奖页
	jcript('href',null,'game.php');
	exit();
			
}

if($_POST){

	$info_array = array(
		'userOpenId' => $_COOKIE['openid'],
		'userName' => inject_check($_POST['userName']),
		'userCompany' => inject_check($_POST['userCompany']),
		'userPhone' => inject_check($_POST['userPhone']),
		'addTime' => strtotime('now')	
	); 

	$bool = $db->insert('gh_user', $info_array);

	if($bool){
		jcript('href',null,'game.php');
		exit();
	}else{
		echo '<script>alert("提交失败，请重新再试！");</script>';
		exit();
	}

}

$smarty->display('index.html');

?>