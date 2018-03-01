<?php 
	include_once("libs/Smarty.class.php");
	$smarty = new Smarty;
	$smarty->template_dir = 'templates/';
	$smarty->compile_dir = 'templates_c/';
	$smarty->caching = false;
	$smarty->left_delimiter = '{{';
	$smarty->right_delimiter = '}}';
?>