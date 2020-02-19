
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
  <title>Preparation list</title>
    <script src="jS/script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link  rel='stylesheet' href='CSS/Preplist.css' type='text/css'>
  <link  rel='stylesheet' href='CSS/prep.css' type='text/css'>
  <link  rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css'>
  <script src="JS/Preplist.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script type="text/javascript" src="script.js"></script>

</head>

<body>
<div class = "wrapper">

      <div class="grid-container">

         <div class="item1">
           <div class="header">
             <h1>E-Training with Preparation list</h1>
             <p1>Section: Larder</p1>
           </div>
         </div>
         <div class="item2">
           <nav class="navbar">
                <a href="Components.php">Components</a>
                <b><a href="Preplist.php" id = "selected">Preparation List</a></b>
                <a href="Training.php">Training</a>
                <a href="Account.php">Account</a>
                <a href="logout.php" id= "bb">Log out</a>
         </nav>
        </div>

         <div class="item4">
           <div class="fourth">
             <h3>Preparation List</h3>
             <ul>
               <li class="draggable" id="draggable" draggable="true">Food goes here</li>
              <li class="draggable"id="draggable" draggable="true">Sauce</li>
             </ul>
         </div>

       </div>

         <div class="item5">
         <div class="fifth">
           <h3>Search Components</h3>
           <div class="adder">
             <div class="search-box">
             <input type="text" id="search" class="input" autocomplete="off" placeholder="Add items in your list..">
             <div id="display"></div>
             <span class="add">+</span>

           </div>
         </div>
         </div>
      </div>

         <div class="item6">
           <div class="sixth">
             <h1>Training advice</h1>
             <p1>
               Lorem ipsum dolor sit amet, cu legere possim eloquentiam pro. Autem iudico necessitatibus et per, ex nec aliquid officiis. Usu feugiat similique ei, impetus forensibus eu sea. At sea blandit percipit accusata, brute argumentum signiferumque ea cum. Ex erat causae fabellas usu. Id adhuc perfecto eum, an tantas tractatos tincidunt nam, ea ius mutat complectitur.
             </p1>
           </div>
         </div>

        <div class="logo">
          <img src="Media/Logo.jpg" alt="Chef hat">
        </div>
     </div>
</div>
</body>

<footer>
  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  <script src="JS/pageup.js"></script>
  <script src="JS/Preplist.js"></script>
</footer>

</html>
