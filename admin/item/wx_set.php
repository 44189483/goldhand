<?php
include_once('../../include/global.php');
include_once('../inc.php');
include_once($CLA.'class.cropimg.php');

$table = 'gh_option';

$thispage = 'wx_set.php';

//网站信息
$option = $db->get_all($table,"WHERE optionType='wx'");
if($option){
	foreach($option as $k => $v){
		$site[$v['optionKey']] = $v['optionValue'];
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>基础信息配置</title>
	<link rel="stylesheet" href="../css/style.css" />
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/jQuery.plus.extend.js"></script>
	<script src="../js/jquery.main.js"></script>
</head>
<body class="bodyGrey">
	<div class="mainTitle">
	  <p>基础信息配置</p>
    </div>
	<div class="table01">
	<form action="?do=save" method="post" enctype="multipart/form-data" name="form1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<th>appid</th>
				<td><input class="w380h24" type="text" name="appid" value="<?php echo $site['appid'];?>" style="width:200px;" /></td>
            </tr>
            <tr>
				<th width="60">appsecret</th>
				<td><input class="w380h24" type="text" name="appsecret" value="<?php echo $site['appsecret'];?>" style="width:200px;"/></td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td><input class="btn02" type="submit" value="确认设置" /></td>
            </tr>
		</table>
	  </form>
	</div>
	<!--table01 block end-->
</body>
</html>
<?php

if($_GET['do'] == 'save'){
	
	//更新
	
	if($_POST){

		$db->execute("DELETE FROM {$table} WHERE optionType='wx'");//先清空 

		$array = array(
			'appid' => $_POST['appid'],
			'appsecret' => $_POST['appsecret'],
			'accesstoken' => '',
			'ticket' => '',
			'lasttime' => ''
		);

		foreach($array as $k => $v){

			$info_array = array(
				'optionType' => 'wx',
				'optionKey' => $k,
				'optionValue'=> $v
			);   

			$db->insert($table, $info_array);

		}

		jcript('all','操作完成！',$thispage);

	}

}
?>