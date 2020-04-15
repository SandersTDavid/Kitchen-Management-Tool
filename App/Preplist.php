
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
  <title>Preparation list</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link  rel='stylesheet' href='CSS/Preplist.css' type='text/css'>
  <link  rel='stylesheet' href='CSS/prep.css' type='text/css'>
  <link  rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css'>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script type="text/javascript" src="JS/script.js"></script>


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
                <a href="Components.php">Components</a>
                <b><a href="Preplist.php" id = "selected">Preparation List</a></b>
                <a href="Training.php">Training</a>
                <a href="Account.php">Account</a>
                <a href="logout.php" id= "bb">Log out</a>
         </nav>
        </div>
        <div class="item3">
          <div class="third">
            <h1>Phase Two</h1>
            <p1>
               Search for the components that have been added in phase one, in the drop down list select the desired product.
               <br>
               Add thess to the preparation list and drag and drop to the desired position.
            </p1>
           </div>
        </div>

        <div class="item4">
           <div class="fourth">
             <h3>Preparation List</h3>
               <h1>Total Time: <div id="totalTime"></div></h1>
             <table class="mytable" id="mytable">
               <tr>
                 <th>Component</th>
                 <th>Category</th>
                 <th>Time</th>
               </tr>
                 <div id="addRow"></div>
            </table>
         </div>
       </div>

       <div class="item5">
         <div class="fifth">
           <h3>Search Components</h3>
            <div class="adder">
             <input type="text" id="search" class="input" autofocus autocomplete="off" placeholder="Add items in your list.." onkeyup="success()">
             <div id="display"></div>
             <span id='btn' class="add" onclick="clearText()">+</span>
             <input type"text" class="input2" id="search2" autocomplete="off" disabled>
             <div id="display2"></div>
             <input type"text" class="input3" id="search3" autocomplete="off" disabled>
             <div id="display3"></div>
           </div>
         </div>
      </div>

       <div class="item6">
         <div class="sixth">
           <h1>Training advice</h1>
           <p1>
             To get the total time of the list make sure that the data is correct when selecting from the list.
             <br>
             Trainee chef must first order the list and the section chef must check whether it is correct.
             <br>
             If it is not correct, the advice to give would be to order components so that cooking of various items can take place
             whilst other items can be prepared.
             <br>
             An efficient order would be to put some items in to cook at the start of the day, but remember it could be limited to how
             many spaces in the oven there is.
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
  <script type="text/javascript" src="JS/pageup.js"></script>
  <script type="text/javascript" src="JS/Preplist.js"></script>
</footer>

</html>
