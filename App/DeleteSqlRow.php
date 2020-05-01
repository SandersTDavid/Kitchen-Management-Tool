<?php

include "config.php";

$id = $_GET['id'];

$sql = "DELETE FROM food WHERE food_id = $id";

if($stm = mysqli_prepare($link, $sql)){
   mysqli_stmt_execute($stm);
   mysqli_stmt_close($stm);
    header('Location: components.php');
    exit;
} else {
    echo "Error deleting record";
}
?>
