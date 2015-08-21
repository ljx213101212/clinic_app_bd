<?php

$response = array();
require_once __DIR__ .'/db_connect.php';

if (isset($_POST['address_1']) && isset($_POST['address_2'])
	 && isset($_POST['clinic'])) {

	$address_1 = $_POST['address_1'];
	$address_2 = $_POST['address_2'];
	$clinic    = $_POST['clinic'];

	//import db connect class

	$db  = new DB_CONNECT();
	$sql = "INSERT INTO clinic(address_1, address_2, clinic)
        VALUES('$address_1', '$address_2', '$clinic')";
	$conn   = $db->connect();
	$result = mysql_query($sql, $conn);

	if (!$result) {
		//add response
		$response["success"] = 1;
		$response["message"] = "Could not enter data";
		echo json_encode($response);
		die('Could not enter data: '.mysql_error());
	} else {

		$response["success"] = 0;
		$response["message"] = "Entered data successfully\n";
		echo "Entered data successfully\n";
		echo json_encode($response);
	}

	// if ($result){

	//     $res
	// }
	echo "success";
	//echo $result;

} else {
	$response["success"] = 0;
	$response["message"] = "the parameter is not provided properly\n";
	echo "fail";
}

//curl --data "address_1=123&address_2=234&clinic=456" http://127.0.0.1:8888/clinic_app_be/db_create.php

?>