<?php 
	session_start();
	include_once('../include/global.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css" />
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/jQuery.plus.extend.js"></script>
	<script src="js/jquery.main.js"></script>
	<script type="text/javascript">
    	function sideNav() {
    		$(".sideNav>ul>li>span").click(function(){
     			$(this).parent().toggleClass("selected")
     		});
   		}
    </script>
</head>
<body onload="sideNav()">
	<div class="sideNav">
		<ul>
			<li>
				<span>微信接口</span>
				<ul>
					<li>
						<dl>
							<dd><a href="item/wx_set.php" target="rightMain" title="设置">设置</a></dd>
						</dl>
					</li>
				</ul>
			</li>
			<li>
				<span>奖品管理</span>
				<ul>
					<li>
						<dl>
							<dd><!--<a href="item/prize.php?act=add" target="rightMain" title="添加">添加</a> | --><a href="item/prize.php" target="rightMain" title="管理">管理</a></dd>
						</dl>
					</li>
				</ul>
			</li>
			<li>
				<span>会员管理</span>
				<ul>
					<li>
						<dl>
							<dt>参与者</dt>
							<dd><a href="item/user.php" target="rightMain" title="名单">名单</a></dd>
						</dl>
						<dl>
							<dt>中奖者</dt>
							<dd><a href="item/user.php?status=1" target="rightMain" title="名单">名单</a></dd>
						</dl>
					</li>
				</ul>
			</li>
			<li>
				<span>CNZZ流量统计</span>
				<ul>
					<li>
						<dl>
							<dd><a href="http://www.cnzz.com/stat/website.php?web_id=1259081432" target="rightMain">统计</a></dd>
						</dl>
					</li>
				</ul>
			</li>           		
			<li>
				<span>密码设置</span>
				<ul>
					<li>
						<dl>
							<dt>修改密码</dt>
							<dd><a href="item/set_pwd.php" target="rightMain" title="管理">管理</a></dd>
						</dl>
					</li>
				</ul>
			</li>    
			<li class="selected">
				<span>版权信息</span>
				<ul>
					<li><p>版权所有：aidimedia.com</p></li>
					<li><p>技术支持：aidimedia.com</p></li>
				</ul>
			</li>
		</ul>
	</div>
</body>
</html>