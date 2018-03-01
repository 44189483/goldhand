<?php
include 'include/common.php';

/*防止直接跨页访问得奖信息*/

//非正常登陆
if(!isset($_COOKIE['openid'])){

	jcript('href',null,'main.php');
	
	exit();

}else if(empty($_GET['pid'])){
	
 	jcript('href',null,'game.php');
	
 	exit();

}else{

	//用户

	$user = $db->get_one("gh_user","WHERE userOpenId='{$_COOKIE['openid']}'");

	$smarty->assign("user", $user);

	//奖品信息
	$pro = $db->get_one("gh_prize","WHERE prizeId={$_GET['pid']}");

	$smarty->assign("pro", $pro);

}

$smarty->display('prize.html');

?>