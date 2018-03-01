<?php
require($FUNC.'function.use.php');
if(empty($_SESSION['admin'])){
 	jcript('href','','login.php');
 	exit();
}