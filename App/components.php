<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
?>
<?php
require_once "config.php";

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
          $ftime_err = "Please enter a time in minutes.";
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
  <title>Components</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <link  rel='stylesheet' href='CSS/component.css' type='text/css'>
  <link  rel='stylesheet' href='CSS/menu.css' type='text/css'>
 <!-- Favicon -->
 <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
 <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
 <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
 <link rel="manifest" href="/site.webmanifest">
 <script type="text/javascript" src="JS/componentScript.js"></script>
</head>

<body>
<div class = "wrapper">
<div class="grid-container">

<div class="item1">
 <div class="header">
 <h1>Chefs E-Training</h1>
 </div>
</div>

<div class="item2">
 <nav class="navbar">
 <b><a href="components.php" id = "selected">Components</a></b>
 <a href="preparationlist.php">Preparation List</a>
 <a href="training.php">Training</a>
 <a href="account.php">Account</a>
 <a href="logout.php" id= "bb">Log out</a>
 </nav>
</div>

<div class="item3">
 <div class="third">
 <h2>Add Component</h2>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
 <div ="container">
 <div class="A">
 <div class="componentBox">
 <p1>Component Name</p1>
 </br>
 <input type="text" name="food_name" id="textbox" name="textbox" value="<?php echo $food_name; ?>">
 <br>
 <span class="help-block"><?php echo $fname_err; ?></span>
 </div>
</div>

<div class="B">
 <div class="selectoption">
 <p> </p>
 <p1>Component Category</p1>
 <div class="setRadio">
 <input type="radio" id="radioCook"name="food_category"
 <?php if(isset($food_category))  echo "checked"; ?>
 value="Cook" label="COOK"><label for="radioCook">COOK</label>
 <input type="radio" id="radioPrepare" name="food_category"
 <?php if(isset($food_category)) echo "checked"; ?>
 value="Prepare" label= "PREPARE"><label for="radioPrepare">PREPARE</label>
 <input type="radio" id="radioOther" name="food_category"
 <?php if(isset($food_category)) echo "checked"; ?>
 value="Other"><label for="radioOther">OTHER</label>
 </div>
 </div>
</div>
 </br>

<div class ="C">
 <div class="componentBox <?php echo (!empty($fcategory_err)) ? 'has-error' : ''; ?>">
 </br>
 <p1>Component Time (Mins)</p1>
 </br>
 <input type="number" name="food_time" id="textbox" min="1" value="<?php echo $food_time; ?>">
 <br>
 <span class="help-block"><?php echo $ftime_err; ?></span>
 </div>
</div>

<div class="D">
 <div class="form-group" id = "center_buttons">
 <input type="submit" class="btn" value="Add">
 </div>
 </div>
</div>
</form>
</div>
</div>

<div class="item4">
 <div class="fourth">
 <h2>Component Record</h2>
 <table>
 <thead>
 <tr>
 <th>Component</th>
 <th>Category</th>
 <th>Time</th>
 <th></th>
 </tr>
 </thead>
 <tbody>
 <?php
 $sql = "SELECT * FROM food ORDER BY food_name asc";
 $result = $link->query($sql);
 if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 echo "<tr ><td>" . $row["food_name"] . "</td><td>" . $row["food_category"] . "</td><td>" . $row["food_time"]."</td>" ;
 echo "<td>". "<a href='DeleteSqlRow.php?id=" . $row["food_id"] . "'>Delete</a>" . "</td>";
 echo "</tr>";
  }
}
else {
echo "<tr><td>" . $fname_err . "</td><td>" . $fcategory_err ."</td><td>" . $ftime_err . "</td></td>";
}
?>
</tbody>
</table>

<div class="moveDeletebtn">
 <form action="DeleteSqlTable.php" method="post">
 <input type="submit" name="delete" class="delete" id="delete" value="Delete List"></input>
 </form>
</div>
</div>
</div>

<div class="item5">
 <div class="fifth">
 <h1>Phase One</h1>
 <p1>Add every single item that has to be prepared on the section.
 <br> It is important to add the time of the component in minutes, don't forget that the time is from start to finish and not just how long it takes in the oven.
 </p1>
 </div>
</div>

<div class="item6">
 <div class="sixth">
 <h1>Training advice</h1>
 <p1>It is key to know of every single item to build a picture of what needs to be prepared and maintained on a daily basis. If one such item is missing from the section
  the service will have to wait for it causing the customer to wait for their meal, or even worse, to be taken off the menu.
 </section>
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
