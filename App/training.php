<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$employee_fname = $_SESSION["fname"];
$employee_lname = $_SESSION["lname"];

?>

<!DOCTYPE html>
<head>
 <meta charset="utf-8">
 <title>Training Guide</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
 <link  rel='stylesheet' href='CSS/training.css' type='text/css'>
 <link  rel='stylesheet' href='CSS/menu.css' type='text/css'>
<!-- Favicon -->
 <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
 <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
 <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
 <link rel="manifest" href="/site.webmanifest">
</head>

<body>
<div class = "wrapper">
      <div class="grid-container">
         <div class="item1">
           <div class="header">
                <h3>Chefs E-Training</h3>
                <p id="greeting">Welcome, <b><?php echo htmlspecialchars($employee_fname); ?> <?php echo htmlspecialchars($employee_lname); ?></b></p>

           </div>
         </div>
         <div class="item2">
           <nav class="navbar">
                <a href="components.php">Components</a>
                <a href="preparationlist.php">Preparation List</a>
                <b><a href="training.php" id = "selected">Training</a></b>
                <a href="account.php">Account</a>
                <a href="logout.php" id= "bb">Log out</a>
         </nav>
        </div>

         <div class="item3">
         <div class="third">
           <h1>Training Guide</h1>
           <p1>
            Every Chef needs to get to know the section that they start on. Most will be thrown on the section without any training and asked to prepare food straight away.
              <br>
              <br>
             Here we have two training tools which can help the initial start of training and to continue the begining stages of chefs learning the trade.
             <br>
            <br> Below <b>training phase one</b> allows the chef to go through their section and write down every component that their section has and they need to prepare. They will have to ask the
             current section chef a method to prepare for each component and a time that it takes from start to finish.
             <br>
             <br>
             Next, <b>training phase two</b> allows the chef to add specific components to a daily preplist and to move them around to find the most suitable order to prepare them in.
            <br>
            <br>
             The aim is to get the new chef to order the preplist in the position they think is best and then get the section chef to check over and tell them the most suitable
             way. This list will also provide a total time of preparation so that the chef can get a good idea on how long they have to be ready for service.
            </p1>
         </div>
         </div>
         <div class="item4">
           <div class="fourth">
             <img src="Media/PhaseOne.png" alt="Training Phase One" width="500px">
         </div>
       </div>
         <div class="item5">
           <div class="sidebyside">
         <div class="fifth">
           <h1>Components Phase</h1>
           <p2>Chef, follow these instructions for phase one training:
             <ul>
               <li>Ask your section chef to complete this with you</li>
               <li>Go to the components page in the menu</li>
               <li>Go to your section and take everything out of the fridge and off the shelves</li>
               <li>One-by-one write down each component and ask whether it needs cooking and how long it takes to make</li>
               <li>Enter each component into the form online correctly</li>
            </ul>
            <br>
           </p2>
            </div>
            <div class="fifth2">
           <h1>Benefits:</h1>
           <p2>
             When a chef is asked to work on a new section they must know exactly what is on that section and how much time each component takes to prepare.
            <br>
            <br>
             Experienced chefs know enough to predict how long things take most of the time but as a new chef it is vital to grasp this concept as soon as possible.
            <br>
            <br>
            Once this has been learned it is encouraged that the chef does this first thing every day as it helps to get a complete picture on what work needs to be done.
            <br>
            <br>
           </p2>
        </div>
      </div>
         </div>
         <div class="item6">
           <div class="sidebyside">
           <div class="sixth">
             <h2>Preparation List Phase</h2>
             <p3>
                Phase one must be completed first for this phase to commence.
                <br>
                <br>
                Training is recommended at the end of a shift as follows:
                <ul>
                  <li>Go to the Preparation list page</li>
                  <li>Make sure the section chef is free to do this with the trainee</li>
                  <li>Add each component that needs to be prepared for the next day/shift</li>
                  <li>Trainee chef must put the list in the order they think they should prepare each item</li>
                  <li>Section chef must discuss the correctness of order based on the most efficient way to prepare items and save time</li>
                  <li>Trainee chef must have another go until the section chef approves</li>
                  <li>The list can be used for next days work</li>
                </ul>
                <br>
                <br>
             </p3>
              </div>
              <div class="sixth2">
             <h2>Benefits:</h2>
             <p3>
               An organised list can not only save the chef time but can free up time for them to help others.
               <br>
               <br>
               As this is recommended to be completed before the next shift, it will save 10 - 15 mins doing it at the start of the shift.
               <br>
               <br>
               Helps to give the trainee an idea of the whole process before jumping straight in, this will minimise interruption to the daily kitchen process.
             </p3>
          </div>
        </div>
         </div>
         <div class="item7">
           <div class="seventh">
            <img src="Media/PhaseTwo.png" alt="Training Phase Two" >
          </div>
         </div>
<div class="logo">
        <div class="logo">
          <img src="Media/Logo.jpg" alt="Chef hat">
        </div>
      </div>
     </div>
</div>
</body>

<footer>
  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  <script src="JS/pageup.js"></script>

</footer>

</html>
