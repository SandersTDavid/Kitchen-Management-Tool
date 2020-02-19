<?php

// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

?>

<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <title>test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
     <title>Live Search using AJAX</title>
     <!-- Including jQuery is required. -->
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
     <link rel="stylesheet" type="text/css" href="style.css">
     <script type="text/javascript" src="script.js"></script>
     <!-- Including CSS file. -->

  </head>
  <body>
  <!-- Search box. -->
     <input type="text" id="search" placeholder="Search" />
     <!-- Suggestions will be displayed in below div. -->
     <div id="display"></div>
  </body>

<footer>

</footer>
</html>
