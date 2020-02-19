<?php

include "config.php";

if (isset($_POST['search'])) {
   $Name = $_POST['search'];
   $Query = "SELECT food_name FROM food WHERE food_name LIKE '%$Name%' ";
   $ExecQuery = MySQLi_query($link, $Query);
   echo '
<ul>
   ';
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
   <li onclick='fill("<?php echo $Result['food_name']; ?>")'>
   <a>
       <?php echo $Result['food_name']; ?>
   </li></a>
   <?php
}}
?>
</ul>
