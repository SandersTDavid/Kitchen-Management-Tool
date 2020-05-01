<?php

include "config.php";

if (isset($_POST['delete']))
{
$sql = "DELETE FROM food";

if($stm = mysqli_prepare($link, $sql)){
   mysqli_stmt_execute($stm);
   mysqli_stmt_close($stm);
    header('Location: Components.php');
    exit;
}
 else {
    echo "Error deleting table, please refresh page";
}
}
?>
