<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <title>Training</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!--  <script src="js/script.js"></script> -->
  <link  rel='stylesheet' href='CSS/Training.css' type='text/css'>
</head>

<body>
<div class = "wrapper">
      <div class="grid-container">
         <div class="item1">
           <div class="header">
                <h1><b>iCanPrep</b> Chefs E-Training with Preparation List</h1>
           </div>
         </div>
         <div class="item2">
           <nav class="navbar">
             <ul>
                <li><a href="Components.php">Components</a></li>
                <li><a href="Preplist.php">Preparation List</a></li>
                <li id = "selected"><b><a href="Training.php">Training</a></b></li>
                <li><a href="Account.php">Account</a></li>
                <li id= "bb"><a href="logout.php">Log out</a></li>
            </ul>
         </nav>
        </div>
         <div class="item3">
         <div class="third">
           <h1>Training tips</h1>
           <p1>Lorem ipsum dolor sit amet, cu legere possim eloquentiam pro. Autem iudico necessitatibus et per, ex nec aliquid officiis. Usu feugiat similique ei, impetus forensibus eu sea. At sea blandit percipit accusata, brute argumentum signiferumque ea cum. Ex erat causae fabellas usu. Id adhuc perfecto eum, an tantas tractatos tincidunt nam, ea ius mutat complectitur.
           </p1>
         </div>
         </div>
         <div class="item4">
           <div class="fourth">
             <img src="Media/grapefruit.jpg" alt="grapefruit">
         </div>
       </div>
         <div class="item5">
         <div class="fifth">
           <h1>Training advice</h1>
           <p1>Lorem ipsum dolor sit amet, cu legere possim eloquentiam pro. Autem iudico necessitatibus et per, ex nec aliquid officiis. Usu feugiat similique ei, impetus forensibus eu sea. At sea blandit percipit accusata, brute argumentum signiferumque ea cum. Ex erat causae fabellas usu. Id adhuc perfecto eum, an tantas tractatos tincidunt nam, ea ius mutat complectitur.
             Lorem ipsum dolor sit amet, cu legere possim eloquentiam pro. Autem iudico necessitatibus et per, ex nec aliquid officiis. Usu feugiat similique ei, impetus forensibus eu sea. At sea blandit percipit accusata, brute argumentum signiferumque ea cum. Ex erat causae fabellas usu. Id adhuc perfecto eum, an tantas tractatos tincidunt nam, ea ius mutat complectitur.
           </p>
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

</footer>

</html>
