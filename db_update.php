<?php

//func_no = 1
function update_by_id($id) {
	if (isset($_POST['id']) && isset($_POST['address_1']) && isset($_POST['address_2']) && isset($_POST['clinic'])) {

		$id        = $_POST['id'];
		$address_1 = $_POST['address_1'];
		$address_2 = $_POST['address_2'];
		$clinic    = $_POST['clinic'];

		$sql = "UPDATE clinic SET address_1 = '$address_1', address_2 = '$address_2', clinic = '$clinic' WHERE id = $id";

		$result = mysql_query($sql);
		return $result;

	} else {
		$response["success"] = 0;
		$response["message"] = "parameter is not provided properly";

		// echoJSON response
		echo json_encode($response);
		return 0;
	}

}

$response = array();
require_once __DIR__ .'/db_connect.php';
$db = new DB_CONNECT();

if (isset($_POST['func_no'])) {
	$func_no = $_POST['func_no'];
	switch ($func_no) {
		case 1:
			$result = update_by_id($_POST['id']);
			if ($result) {
				$response["success"] = 1;
				$response["message"] = "updated successfully";

				// echo JSON response
				echo json_encode($response);
			}
			break;
		default:
			$response["success"] = 0;
			$response["message"] = "wrong func_no as a parameter";

			// echoJSON response
			echo json_encode($response);
			break;

	}

} else {
	$response["success"] = 0;
	$response["message"] = "Need 'func_np' as a must need
    parameter for choosing the type of update action";

	// echoJSON response
	echo json_encode($response);
}

//curl --data "func_no=1&id=192&address_1=999&address_2=999&clinic=999" http://127.0.0.1:8888/clinic_app_be/db_update.php
?>