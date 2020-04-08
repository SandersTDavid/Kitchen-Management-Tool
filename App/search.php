<?php

include "config.php";

$arr = array();
if (!empty($_POST['keywords']) && strlen($_POST['keywords']) >= 3) {
	$keywords = filter_var($_POST['keywords'], FILTER_SANITIZE_STRING);
	$keywords = $db->real_escape_string($keywords);
	$sql = "SELECT food_name, food_category, food_time FROM food WHERE food_name LIKE '%".$keywords."%' ";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('food_name' => $obj->food_name, 'food_category' => $obj->food_category, 'food_time' => $obj->food_time);
		}
	}
}
echo json_encode($arr);
