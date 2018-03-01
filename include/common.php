<?php
	/*网站前台公共文件*/
	include 'global.php';
	include 'smarty.php';
	include 'function/function.use.php';
	require_once 'sdk.php';

	$config['debug'] = getConfig('debug');
	$config['appId'] = getConfig('appId');
	$config['timestamp'] = getConfig('timestamp');
	$config['nonceStr'] = getConfig('nonceStr');
	$config['signature'] = getConfig('signature');
	$config['jsApiList'] = getConfig('jsApiList');
 
	$smarty->assign("config", $config);

	//安全 防MYSQL注入
	inject_check($_SERVER["QUERY_STRING"]);

?>