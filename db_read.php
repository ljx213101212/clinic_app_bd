<?php

function query_all() {
	$result = mysql_query("SELECT *FROM clinic") or die(mysql_error());
	return $result;
}

function query_by_id($id) {

	$result = mysql_query("SELECT *FROM clinic WHERE id = $id");
	return $result;
}

$response = array();

require_once __DIR__ .'/db_connect.php';

$db = new DB_CONNECT();

$result = "";
if (isset($_GET['id'])) {
	$result = query_by_id($_GET['id']);
} else {
	$result = query_all();
}

if (!empty($result)) {

	if (mysql_num_rows($result) > 0) {
		// looping hasil
		$response["clinic"] = array();

		while ($row = mysql_fetch_array($result)) {
			$clinic              = array();
			$clinic["id"]        = $row["id"];
			$clinic["address_1"] = $row["address_1"];
			$clinic["address_2"] = $row["address_2"];
			$clinic["clinic"]    = $row["clinic"];

			#echo $clinic["clinic"];
			//echo $clinic["clinic"]
			#print_r(array_values($clinic));
			array_push($response["clinic"], $clinic);
		}
		// sukses
		$response["success"] = 1;

		//echo $response["clinic"];

		// echo JSON response
		echo json_encode($response);
	} else {
		$response["success"] = 0;
		$response["message"] = "Tidak ada data yang ditemukan";

		echo json_encode($response);
	}

}

?>