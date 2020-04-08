<?php

include "config.php";

if (isset($_POST['search']) && strlen($_POST['search']) >= 2) {
   $Name = $_POST['search'];
   $Query = "SELECT food_name, food_category, food_time FROM food WHERE food_name LIKE '%$Name%' ";
   $ExecQuery = MySQLi_query($link, $Query);
   echo '
<ul>
   ';
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
   <li onclick='fill("<?php echo $Result['food_name']; ?>")'>
     <p  onclick='fill2("<?php echo $Result['food_category']; ?>")'>
      <p2  onclick='fill3("<?php echo $Result['food_time']; ?>")'>

   <a>
       <?php echo $Result['food_name']; ?>
        <?php echo $Result['food_category']; ?>
         <?php echo $Result['food_time']; ?>

   </li></a>
   <?php
}}
?>
</ul>
