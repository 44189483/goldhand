<?php
/* Smarty version 3.1.29, created on 2017-03-02 01:36:47
  from "E:\xampp\htdocs\gold-hand\templates\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_58b7772f1603a7_50894756',
  'file_dependency' => 
  array (
    '03c9f3948a5e541bd45b2eadaa5273b80e120601' => 
    array (
      0 => 'E:\\xampp\\htdocs\\gold-hand\\templates\\index.html',
      1 => 1463455511,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:foot.html' => 1,
  ),
),false)) {
function content_58b7772f1603a7_50894756 ($_smarty_tpl) {
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		<div class="container">
			<div class="main">
				<div class="header">
					<div class="header-left"></div>
					<div class="header-right"></div>
				</div>
				<div class="round"></div>
				<div class="getInfo">
					<div class='index-end'>本次活动已结束</div>
					<!--<form name="form" method="POST" action="">
						<div class="input name"><input class="" name="userName"  type="text" placeholder="请输入您的姓名"></div>
						<div class="input company" ><input class="" name="userCompany" type="text" placeholder="请输入您的公司名称"></div>
						<div class="input phone"><input class="" name="userPhone" type="text" placeholder="请输入您的手机号"></div>
						<div class="btn">
							<button onclick="return checkform(this.form)">开始</button>
						</div>
					</form>-->
				</div>
			</div>
			<div class="rollBg rollBgAnimation"></div>
		</div>
		<div class="loginPop">
			<div class="loginPop-container">
				<div class="loginPop-container-title">错误提示</div>
				<div class="loginPop-container-line"></div>
				<div class="loginPop-container-text">请您填写正确的</div>
				<div class="loginPop-container-error">姓名、公司、电话</div>
				<div class="loginPop-container-text">以便领奖哦！</div>
			</div>
		</div>
<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:foot.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
> 
	//隐藏右上角菜单
	function onBridgeReady(){
		WeixinJSBridge.call('hideOptionMenu');
	}

	if (typeof WeixinJSBridge == "undefined"){
		if( document.addEventListener ){
			document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
		}else if (document.attachEvent){
			document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
			document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
		}
	}else{
		onBridgeReady();
	}
<?php echo '</script'; ?>
><?php }
}
