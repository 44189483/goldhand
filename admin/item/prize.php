<?php 
	include_once('../../include/global.php');
	include_once('../inc.php');
	include_once($CLA.'class.cropimg.php');
	include_once($CLA.'class.page.php');

	/**************************************************************/

	$table = 'gh_prize';

	$thispage = 'prize.php';

	$act = $_GET['act'];

	$pid = $_GET['pid'];

	/********************************************************************/

	//编辑查看
	if(!empty($pid)){

		$row = $db->get_one($table,"WHERE prizeId={$pid}");

	}

	//列表
	if(empty($act)){

		$name = $_GET['name'];//名称

		if(!empty($name)){
			$sql .= " AND prizeName='{$name}'";
		}

		$total = $db->count($table,$where);//获取总记录数

		$length = 5;

		$page = new page_link();

		$page->page_linkTo($total,$length,'p');

		$rows = $db->get_some($table,$page->firstcount,$length,null,$where." ORDER BY prizeId DESC");  

	}
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
	<script type="text/javascript">
		function checkform(form){
			if(form.proname.value.Trim()==""){
				Alert("商品名称必须填写!");
				form.proname.focus();
				return false;
			}
			if(form.num.value.Trim()==""){
				Alert("商品数量必须填写!");
				form.num.focus();
				return false;
			}
		}
	</script>
</head>

<body class="bodyGrey">
	<?php if($act == 'edit' || $act == 'add'):?>
		<div class="mainTitle">
		  <p>奖品查看</p>
	    </div>
		<div class="table01">
			<form action="?act=edit&do=save&pid=<?php echo $pid;?>" method="POST" name="form1" enctype="multipart/form-data" onSubmit="return checkform(this)">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				  <th width="70">奖品名称</th>
				  <td><input type="text" name="proname" value="<?php echo $row['prizeName'];?>" /></td>
	            </tr>
	            <?php if(!empty($row['prizeImg'])){?>
			    <tr>
				  <th>&nbsp;</th>
				  <td>
				  	<img src="../../upload/<?php echo $row['prizeImg'];?>" width="200"/>
				  	<input type="hidden" name="img" value="<?php echo $row['prizeImg'];?>"/>
				  </td>
			    </tr>
			    <?php } ?>
			    <tr>
					<th>奖品图片</th>
					<td>
						<input type="file" name="attchment" size="35" />
						<span>图片尺寸：560px*275px;文件大小：1M以内；</span></td>
				</tr>
				<tr>
					<th>奖品信息</th>
					<td><textarea rows="10" cols="50" name="content"><?php echo $row['prizeContent'];?></textarea></td>
				</tr>
				<tr>
				  <th>奖品数量</th>
				  <td>
				  	<input type="text" class="smallInput" name="num" value="<?php echo $row['prizeNum'];?>" onafterpaste="this.value=this.value.replace(/\D/g,'')" onkeyup="this.value=this.value.replace(/\D/g,'')" />
				  </td>
	            </tr>
	            <?php if($act == 'edit'):?>
	            <tr>
				  <th>已中数量</th>
				  <td>
				  	<?php echo $row['getPrizeNum'];?>
				  </td>
	            </tr>
	            <tr>
				  <th>剩余数量</th>
				  <td>
				  	<?php echo $row['prizeNum'] - $row['getPrizeNum'];?>
				  </td>
	            </tr>
	        	<?php endif;?>
	        	<tr>
				  <th>上架</th>
				  <td>
				  	<input type="checkbox" name="status" value="1" <?php if($row['status'] == 1){ echo 'checked="checked"';}?>/>
				  </td>
	            </tr>
				<tr>
					<th>&nbsp;</th>
					<td>
						<input class="btn02" type="submit" name="submit" value="提 交" />
						<input class="btn02" type="button" value="返 回" onclick="window.history.back();"/>
					</td>
	            </tr>
			</table>
		  </form>
		</div>
	<?php else:?>
		<div class="mainTitle">
			奖品管理
		</div>
		<div class="twoTitle">
			<form id="searchform" name="searchform" method="GET" action="">
				名称
				<input type="text" name="name" style="border:solid #000 1px;color:#666;height:20px;font-faimly:宋体;width:200px;line-height:20px;" value="<?php echo $name;?>" onclick="this.value='';">&nbsp;
				<input type="submit" name="btn" value="查询" style="border:solid #000 1px;" />
			</form>
		</div>
		<form name="form" id="form" method="POST" action="?do=del">
			<div class="table02">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" id="tab">
					<tr>
						<th align="left"><input type="checkbox" id="CheckAll" onclick="selectAll(this,'pid[]')" />全选</th>
						<th>图片</th>
						<th>名称</th>
						<th>总数量</th>
						<th>已中数量</th>
						<th>剩余数量</th>
						<th>上架</th>
						<th>操作</th>
					</tr>
					<?php
						if ($rows){
							foreach ($rows as $k => $v){
					?>
						<tr class="<?php if(($k+1)%2==0)echo 'odd';?>">
							<td><input type="checkbox" name="pid[]" value="<?php echo $v['prizeId'];?>" /></td>
							<td><img src="../../upload/<?php echo $v['prizeImg'];?>" height="75" /></td>
							<td><?php echo $v['prizeName'];?></td>
							<td><?php echo $v['prizeNum'];?></td>
							<td><?php echo $v['getPrizeNum'];?></td>
							<td><?php echo $v['prizeNum'] - $v['getPrizeNum'];?></td>
							<td>
								<input type="checkbox" <?php if($v['status'] == 1){?>checked="checked"<?php }?> value="1" name="status" id="<?php echo $v['prizeId'];?>" onchange="changeCheck(this.id,<?php echo $v['status'];?>,'prize','prizeId');"/>
							</td>
							<td>
								<a href="?act=edit&pid=<?php echo $v['prizeId'];?>" class='redlink'>编辑</a>
							</td>
						</tr>
					<?php 
							}
						}else{ 
					?>
						<tr class="odd">
						  <td colspan="8" style="color:#FF0000;">暂无信息。。。</td>
					    </tr>
				    <?php } ?>
				</table>
			</div>
			<div class="pageWrap">
				<div class="page">
					<?php if($page)echo $page->show_link()?>
					<input name="dels" type="button" onclick="doSelect('pid[]','选中删除将会使曾中奖的用户奖品清空，是否选中删除?');" value="选中删除" class="btn02">
				</div>
			</div>
		</form>
	<?php endif;?>
</body>

</html>
<?php

	//添加编辑
	if($_GET['do'] == 'save'){

		$name = $_POST['proname'];

		$content = $_POST['content'];

		$status = $_POST['status'] == null ? '0' : '1';

		$num = $_POST['num'];

		$imgfile = $_FILES["attchment"];
			
		$max_file_size = 1000000; 	//1m,单位为byte;
		$filetype = array("image/gif","image/jpg","image/jpeg","image/pjpeg","image/png"); //文件类型
				
		//文件存在判断
		if(!empty($imgfile["name"]) && is_uploaded_file($imgfile["tmp_name"])){	
						
			//判断上传文件类型
			if(!in_array($imgfile["type"],$filetype)){
				jcript('all','只能上传gif/jpg/png图像类型文件.',$thispage.'?act=add');
				exit();
			}

			//检查文件大小 
			if($max_file_size < $imgfile["size"]){ 
				jcript('all','文件大小不能超过1M.',$thispage.'?act=add');
				exit();
			}

			$Img = upload($_POST['img'],null,'560','275');
		
		}else{

			$Img = $_POST['img'];

		}

		$info_array = array(
			'prizeName' => $name,
			'prizeImg' => $Img,
			'prizeContent' => $content,
			'prizeNum' => $num,
			'status' => $status
		); 

		if(!empty($pid)){
			$bool = $db->update($table, $info_array, "WHERE prizeId={$pid}");
		}else{
			$bool = $db->insert($table, $info_array);
		}

		if($bool){
			$txt = '操作成功！';
		}else{
			$txt = '操作失败！';
		}

		jcript('all',$txt,$thispage);

	}

	//选中删除
	if($_GET['do'] == 'del') {
		
		if($_POST['pid']){

			$prizes = $db->get_all($table,"WHERE prizeId IN(".implode(',', $_POST['pid']).")");
			foreach ($prizes as $k => $v) {
				@unlink($UPLOAD.$v['prizeImg']);
				//中奖用户奖品复位
				$db->query("UPDATE gh_user SET prizeId=0 WHERE prizeId={$v['prizeId']}");
			}

			$bool = $db->delete($table, "WHERE prizeId IN(".implode(',', $_POST['pid']).")"); 
		
			if($bool){
				$txt = '操作成功！';
			}else{
				$txt = '操作失败！';
			}

			jcript('all',$txt,$thispage);

		}	
   		
	}

?>