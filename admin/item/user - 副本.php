<?php 
	include_once('../../include/global.php');
	include_once('../inc.php');
	include_once($CLA.'class.page.php');

	$table = "gh_user";

	$thispage = 'user.php';

	$status = $_GET['status'];

	$uid = $_GET['uid'];

	$start = $_GET['start'];

	$end = $_GET['end'];

	$where = "WHERE 1=1";

	if($status == 1){
		//中奖者
		$where .= " AND prizeId>0";
	}

	if(!empty($start) && !empty($end)){//时间
		$s = strtotime($start);
		$e = strtotime($end);
		$where .= " AND addtime BETWEEN '{$s}' AND '{$e}'";	
	}

	$total = $db->count($table);//获取总记录数

	$length = 10;

	$page = new page_link();

	$page->page_linkTo($total,$length,'p');

	$rows = $db->get_all($table,$where." ORDER BY userId DESC LIMIT {$page->firstcount},{$length}"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="../css/style.css" />
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/jQuery.plus.extend.js"></script>
	<script src="../js/jquery.main.js"></script>
	<script src="<?php echo $PLU;?>My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript">
	<!--
		String.prototype.Trim = function()
		{
			return this.replace(/(^\s*)|(\s*$)/g, "");
		}

		function delSelect(){
			if (confirm('是否删除选中的信息?')){
				document.form.submit();
			}
		}
	//-->
	</script>
</head>

<body class="bodyGrey">
	<div class="mainTitle">
	  <p><?php echo $status == 1 ? '中奖者名单' : '参与者名单'; ?></p>
    </div>
	<div class="twoTitle">
		<form id="searchform" name="searchform" method="GET" action="">
			时间<input style="width:150px;" type="text" class="Wdate" name="start" onClick="WdatePicker()" readonly="readonly" value="<?php if(!empty($start))echo $start;?>" /> - <input style="width:150px;" type="text" class="Wdate" name="end" onClick="WdatePicker()" readonly="readonly" value="<?php if(!empty($end))echo $end;?>" />&nbsp;
			<input type="submit" name="btn" value="查询" style="border:solid #000 1px;" />
		</form>
	</div>
	<form name="form" id="form" method="POST" action="?do=del">
	<div class="table02">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tab">
			<tr>
				<th>openid</th>
				<th>头像</th>
				<th>微信昵称</th>
				<th>姓名</th>
				<th>公司</th>
				<th>手机</th>
				<th>所获奖品</th>
				<th>已兑奖</th>
				<th>已分享</th>
				<th>时间</th>
			</tr>
			<?php
				if ($rows){
					foreach ($rows as $k => $v){
			?>
				<tr class="<?php if(($k+1)%2==0)echo 'odd';?>">
					<td><?php echo $v['userOpenId'];?></td>
					<td><img src="<?php echo $v['userHeadImg'];?>" height="75"/></td>
					<td><?php echo $v['userNick'];?></td>
					<td><?php echo $v['userName'];?></td>
					<td><?php echo $v['userCompany'];?></td>
					<td><?php echo $v['userPhone'];?></td>
					<td>
						<?php 
							$row = $db->get_one("gh_prize","WHERE prizeId={$v['prizeId']}","prizeName");
							echo $row['prizeName'];
						?>
					</td>
					<td><?php echo $v['getAward'] == 0 ? '否' : '是';?></td>
					<td><?php echo $v['isShared'] == 0 ? '否' : '是';?></td>
					<td><?php echo date('Y-m-d H:i:s',$v['addTime']);?></td>
				</tr>
			<?php 
					}
				}else{ 
			?>
				<tr class="odd">
				  <td colspan="11" style="color:#FF0000;">暂无信息。。。</td>
			    </tr>
		    <?php } ?>
		</table>
	</div>
	<div class="pageWrap">
		<div class="page">
			<?php if($page)echo $page->show_link()?>
		</div>
	</div>
	</form>
</body>
</html>