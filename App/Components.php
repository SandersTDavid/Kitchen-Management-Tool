
<?php
// Initialize the session
session_start();
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

$food_name = $food_time = $food_category = $row = "";
$fname_err = $ftime_err = $fcategory_err = $result = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  // Validate food name
if(empty(trim($_POST["food_name"]))){
    $fname_err = "Please enter a name.";
} else{

  $sql = "SELECT food_id FROM food WHERE food_name = ?";

  if($stmt = mysqli_prepare($link, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_fname);

      // Set parameters
      $param_fname = trim($_POST["food_name"]);

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
          /* store result */
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
              $fname_err = "This component already exists";
          } else{
              $food_name = trim($_POST["food_name"]);
              $food_time = trim($_POST["food_time"]);
              $food_category = trim($_POST["food_category"]);
          }
      } else{
          echo "Oops! Something went wrong. Please refresh page.";
      }

      if(empty(trim($_POST["food_time"]))){
          $ftime_err = "Please enter a time in hours and minutes.";
      } elseif(strlen(trim($_POST["food_time"])) > 5){
          $ftime_err = "Please enter a suitable time less than 60 hours";
      } else{
          $food_time = trim($_POST["food_time"]);
      }

      if (empty(trim($_POST["food_category"]))) {
        $fcategory_errErr = "Please select a category";
      } else {
          $food_category = trim($_POST["food_category"]);
      }
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }


      // Check input errors before inserting in database
      if(empty($fname_err) && empty($ftime_err) && empty($fcategory_err)){

          // Prepare an insert statement
          $sql = "INSERT INTO food (food_name, food_category, food_time) VALUES (?, ?, ?)";

          if($stmt = mysqli_prepare($link, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "sss",$param_fname,$param_fcategory, $param_ftime);

              // Set parameters
              $param_fname = $food_name;
              $param_fcategory = $food_category;
              $param_ftime = $food_time;

              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                echo "Component added!";
              } else{
                  echo "Something went wrong. Please refresh page.";
              }
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }

      if(empty($fname_err) && empty($ftime_err) && empty($fcategory_err)){



      mysqli_stmt_close($stmt);
  }

  // Close statement
 mysqli_stmt_close($stmt);
}
    ?>

<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <title>Components</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!--  <script src="js/script.js"></script> -->
  <link  rel='stylesheet' href='CSS/component.css' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
             <ul>
                <li id = "selected"><b><a href="Components.html">Components</a></b></li>
                <li><a href="Preplist.php">Preparation List</a></li>
                <li><a href="Training.php">Training</a></li>
                <li><a href="Account.php">Account</a></li>
                <li id= "bb"><a href="logout.php">Log out</a></li>

            </ul>
         </nav>
        </div>
         <div class="item3">
         <div class="third">
           <h2>Add Component</h2>

           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             <div class="componentBox">
                 <p1>Component Name</p1>
               </br>
                 <input type="text" name="food_name" id="textbox" value="<?php echo $food_name; ?>">
                 <span class="help-block"><?php echo $fname_err; ?></span>
             </div>

             <div class="selectoption">
                   <p> </p>
                 <p1>Component Category</p1>
               </br>
               <div class="setRadio">

                 <input type="radio" id="radioCook"name="food_category"
                   <?php if(isset($food_category))  echo "checked"; ?>
                    value="Cook" label="COOK"><label for="radioCook">COOK</label>

                    <input type="radio" id="radioFreeze" name="food_category"
                    <?php if(isset($food_category))  echo "checked"; ?>
                     value="Freeze" label=FREEZE><label for="radioFreeze">FREEZE</label>

                     <input type="radio" id="radioPrepare" name="food_category"
                     <?php if(isset($food_category)) echo "checked"; ?>
                      value="Prepare" label= "PREPARE"><label for="radioPrepare">PREPARE</label>

                      <input type="radio" id="radioOther" name="food_category"
                      <?php if(isset($food_category)) echo "checked"; ?>
                       value="Other"><label for="radioOther">OTHER</label>
                   </div>
             </div>
</br>
               <div class="componentBox <?php echo (!empty($fcategory_err)) ? 'has-error' : ''; ?>">

                 </br>
                   <p1>Component Time (Mins)</p1>
                 </br>
                   <input type="number" name="food_time" id="textbox" min="1" value="<?php echo $food_time; ?>">
                   <span class="help-block"><?php echo $ftime_err; ?></span>
               </div>

               <div class="form-group" id = "center_buttons">
                   <input type="submit" class="btn btn-primary" value="Add">

               </div>
           </form>

         </div>
         </div>

         <div class="item4">
           <div class="fourth">
          <table>
            <thead>
                   <tr>
                       <th>Component</th>
                       <th>Category</th>
                       <th>Time</th>
                   </tr>
                 </thead>
                 <tbody>
      <?php
            $sql = "SELECT food_name, food_category, food_time FROM food ORDER BY food_name asc";
              $result = $link->query($sql);

               if ($result->num_rows > 0) {

               while($row = $result->fetch_assoc()) {
                echo "<tr ><td>" . $row["food_name"] . "</td><td>" . $row["food_category"] . "</td><td>" . $row["food_time"]."</td></td>" ;
               }
            }
              else {
                   echo "<tr><td>" . $fname_err . "</td><td>" . $fcategory_err ."</td><td>" . $ftime_err . "</td></td>";
            }

       ?>

     </tbody>
          </table>

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
<script>


function radio_toolbar_click (ev) {
  let checked=document.querySelector('input[name="radio"]:checked');

  if(checked) {
    checked.checked=false;
  }

  ev.target.previousElementSibling.checked=true;
}

</script>
</footer>

</html>
