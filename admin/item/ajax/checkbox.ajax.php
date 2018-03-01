<?php

	include_once('../../../include/global.php');

	$table = $PRFIX.$_POST['table'];//表

	$filed = $_POST['filed'];//字段

	$id = $_POST['id'];//ID

	if(!empty($id)){

		$row = $db->get_one($table, "WHERE {$filed}={$id}");

		$status = $row['status'] == 0 ? 1 : 0;

		$info_array = array(   
			'status' => $status
		);

		$db->update($table, $info_array,"WHERE {$filed}={$id}");

		echo $status;

	}		

?>			