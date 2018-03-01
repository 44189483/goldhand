<?php
include 'include/common.php';

if($_GET['type'] == 'getPid'){

	$sql = "
		SELECT 
			(prizeNum-getPrizeNum) AS count
		FROM
			gh_prize
	";
	$res = $db->result($sql,0,1);

	$user = $db->get_one("gh_user","WHERE userOpenId='{$_COOKIE['openid']}'");

	//以前中奖
	if($user['prizeId'] > 0){

		$pid = $user['prizeId'];

		echo "<a href='prize.php?pid={$pid}'>查看我的奖品></a>";

		exit();

	}else if($_GET['hadprize'] == 1){

		if($res[0]['count'] > 0){

			//新中奖
			$arr = array(); //初始化数组

			//取出现有的奖品
			$rows = $db->get_all("gh_prize","WHERE prizeNum > getPrizeNum","prizeId");
			foreach ($rows as $k => $v) {
				$arr[] = $v['prizeId']; 
			}

			shuffle($arr); //打乱数组顺序

			$pid = array_shift($arr); //输出新数组的第一个值

			//更新得奖信息
			$info_array = array(
				'prizeId' => $pid
			); 

			$db->update("gh_user", $info_array, "WHERE userOpenId='{$_COOKIE['openid']}'");

			//更新商品数量
			$db->query("UPDATE gh_prize SET getPrizeNum=getPrizeNum+1 WHERE prizeId={$pid}");

			echo "<a href='prize.php?pid={$pid}'>查看我的奖品></a>";

			exit();

		}else{

			echo "报歉奖品已全部领完";

			exit();
			
		}

	}

}

//领奖
if($_GET['type'] == 'award'){

	//更新得奖信息
	$info_array = array(
		'getAward' => 1
	); 

	$db->update("gh_user", $info_array, "WHERE userOpenId='{$_COOKIE['openid']}'");

}

}

//更新分享状态
if($_GET['type'] == 'shared'){

	//更新得奖信息
	$info_array = array(
		'isShared' => 1
	); 

	$db->update("gh_user", $info_array, "WHERE userOpenId='{$_COOKIE['openid']}'");

}
?>