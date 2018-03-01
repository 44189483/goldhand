<?php 
	/* Web 基础配置文件
	* By Sun
	* 2016-03-24
	* define比较影响效率 还是使用一般声明变量 并大写
	*/
	session_start();

	//ini_set("display_errors", "On");

	//error_reporting(E_ALL | E_STRICT);
	
	date_default_timezone_set('UTC');

	include_once('class/class.db.php');

	/*项目目录*/
	$APP = '/';
	
	/*工作目录*/
	$ROOT = $_SERVER['DOCUMENT_ROOT'];

	/*文件夹*/
	$INC = $ROOT.$APP.'include/';

	/*引用类*/
	$CLA = $INC.'class/';

	$FUNC = $INC.'function/';

	/*插件目录*/
	$PLU = $APP.'plugins/';

	/***附件路径设置***/

	$UPLOAD = $ROOT.$APP.'upload/';//附件根目录

	/***数据库设置***/

	$DB_HOST = '127.0.0.1';//主机名
	
	$DB_USER = 'root';//用户
	
	$DB_PWD = '';//密码
	
	$DB_NAME = 'db_goldhand';//数据库名称

	$PRFIX = 'gh_';//表前缀
	
	$dsn = array(
		'host'     => $DB_HOST, 
		'user'     => $DB_USER,
		'password' => $DB_PWD, 
		'database' => $DB_NAME   
	);

	$db = new DB($dsn,'mysql');//类型MYSQL

	/*获取当前正确时区时间*/
	$DB_TIME = 'PRC';//????

	$ALL_PS = 'web-sun';

?>