<?php

function delete_by_id($id) {

	$sql    = "DELETE FROM clinic WHERE id = $id";
	$result = mysql_query($sql);
	return $result;
}

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	//import the db connection
	require_once __DIR__ .'/db_connect.php';

	//
	$db = new DB_CONNECT();

	$result = delete_by_id($id);

	echo "affected rows number :";
	echo mysql_affected_rows();
	if (mysql_affected_rows() > 0) {
		$response["success"] = 1;
		$response["message"] = "this $id is deleted";

		//echo json file
		echo json_encode($response);
	} else {
		$response["success"] = 0;
		$response["message"] = "this $id can not be deleted";
		//echo json file
		echo json_encode($response);
		die('this $id can not be deleted '.mysql_error());
	}
} else {
	$response["success"] = 0;
	$response["message"] = "The parameter is not provided properly";
	//echo json file
	echo json_encode($response);
}

//curl --data "id=196" http://127.0.0.1:8888/clinic_app_be/db_delete.php
?>