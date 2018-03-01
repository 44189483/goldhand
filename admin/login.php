<?php
	include('../include/global.php');

	include($FUNC.'function.use.php');

	if(!empty($_SESSION['admin'])){
		jcript('href','','index.php');
	}else{	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>金手指管理系统</title>
	<link rel="stylesheet" href="css/style.css" />
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/jQuery.plus.extend.js"></script>
	<script src="js/jquery.main.js"></script>
	<script type="text/javascript">
	<!--
		
		function checkform(form){

			if (form.username.value.Trim()==""){
				alert("请填写登录用户名!");
				form.username.focus();
				return false;
			}

			if (form.userpwd.value.Trim()==""){
				alert("请填写登录密码!");
				form.userpwd.focus();
				return false;
			}

			if (form.provenum.value.Trim()==""){
				alert("请填写验证码!");
				form.provenum.focus();
				return false;
			}

		}
		
		function RefreshImage(valImageId) {
			var objImage = document.images[valImageId];
			if (objImage == undefined) {
				return;
			}
			var now = new Date();
			objImage.src = objImage.src.split('?')[0] + '?x=' + now.toUTCString();
		}
	//-->
	</script>
</head>

<body class="bodyBg" onload="login()">
	<div class="login">
		<h1>金手指管理系统</h1>
		<form action="" id="loginform" name="loginform" onsubmit="return checkform(this);" method="POST">
			<p><input class="text userName" type="text" name="username" value="" /></p>
			<p><input class="text passWord" type="password" name="userpwd" value="" /></p>
			<p><input class="testCode" type="text" name="provenum" id="provenum" value="" />&nbsp;
			<img src="provenum.php" name="imgCaptcha" id="imgCaptcha" onClick="RefreshImage('imgCaptcha');" class="code"/>
			</p>
			<p>
				<input type="hidden" name="act" value="submit" />
				<input class="loginSubmit" type="submit" value="" />
				<input class="loginReset" type="reset" name="" id="" value="" />
			</p>
		</form>
	</div>
	<?php
		if($_POST['act'] == 'submit'){
		
			$provenum = $_POST["provenum"];

			if($provenum != $_SESSION['authImg']){
				jcript('all','对不起，请输入正确的验证码！','login.php');
				exit();
			}	

			$username = mysql_real_escape_string($_POST['username']);

			$userpwd = md5(mysql_real_escape_string($_POST['userpwd']).$ALL_PS);
			
			$row = $db->get_one("gh_option","WHERE optionType='login' AND optionKey='{$username}' AND optionValue='{$userpwd}'"); 
			
			if(!$row){
				jcript('all','请您输入正确的用户名和密码！','login.php');
				exit();
			}else{
				
				$_SESSION['admin'] = $username;

				jcript('href','','index.php');
			}
		}
	}
	?>
</body>
</html>