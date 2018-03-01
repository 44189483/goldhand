<?php
/* Smarty version 3.1.29, created on 2017-03-02 01:36:47
  from "E:\xampp\htdocs\gold-hand\templates\foot.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_58b7772f1a4916_64703473',
  'file_dependency' => 
  array (
    '3028d63a71d74343bdce13e035c1d4f9bfc80948' => 
    array (
      0 => 'E:\\xampp\\htdocs\\gold-hand\\templates\\foot.html',
      1 => 1462959987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58b7772f1a4916_64703473 ($_smarty_tpl) {
?>
        <?php echo '<script'; ?>
 type="text/javascript" src="http://cdnjs.gtimg.com/cdnjs/libs/jquery/1.11.1/jquery.min.js" ><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="templates/js/index.js" ><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
>
		    wx.config({
		        debug:      <?php echo $_smarty_tpl->tpl_vars['config']->value['debug'];?>
,
		        appId:      <?php echo $_smarty_tpl->tpl_vars['config']->value['appId'];?>
,
		        timestamp:  '<?php echo $_smarty_tpl->tpl_vars['config']->value['timestamp'];?>
',
		        nonceStr:   <?php echo $_smarty_tpl->tpl_vars['config']->value['nonceStr'];?>
,
		        signature:  <?php echo $_smarty_tpl->tpl_vars['config']->value['signature'];?>
,
		        jsApiList:  [<?php echo $_smarty_tpl->tpl_vars['config']->value['jsApiList'];?>
]
		    });
		    $(function(){
		    	$("#cnzz_stat_icon_1259081432").hide();
		    });
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259081432'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1259081432%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));<?php echo '</script'; ?>
>
	</body>
</html>
<?php }
}
