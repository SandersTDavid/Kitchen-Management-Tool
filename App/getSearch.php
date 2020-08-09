<?php
include "config.php";

$type = $_POST['type'];

// Search result
if($type == 1){
    $searchText = $_POST['search'];

    $sql = "SELECT food_id, food_name FROM food where food_name like '%".$searchText."%' order by food_name asc limit 5";

    $result = mysqli_query($link,$sql);

    $search_arr = array();

    while($fetch = mysqli_fetch_assoc($result)){
        $id = $fetch['food_id'];
        $name = $fetch['food_name'];

        $search_arr[] = array("food_id" => $id, "food_name" => $name);
    }

    echo json_encode($search_arr);
}

// get User data
if($type == 2){
    $userid = $_POST['userid'];

    $sql = "SELECT food_id, food_name, food_category, food_time FROM food where food_id = " .$userid;

    $result = mysqli_query($link,$sql);

    $return_arr = array();

    while($fetch = mysqli_fetch_assoc($result)){
        $id = $fetch['food_id'];
        $name = $fetch['food_name'];
        $category = $fetch['food_category'];
        $time = $fetch['food_time'];

        $return_arr[] = array("food_id"=> $id, "food_name" => $name, "food_category" => $category, "food_time" => $time);
    }

    echo json_encode($return_arr);
}
?>
