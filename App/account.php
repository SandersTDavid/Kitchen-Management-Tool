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
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE employee SET employee_password = ? WHERE employee_id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: account.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<head>
 <meta charset="utf-8">
 <title>Account</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
 <link  rel='stylesheet' href='CSS/Account.css' type='text/css'>
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
     <h1>Chefs E-Training</h1>
    </div>
   </div>

  <div class="item2">
    <nav class="navbar">
      <a href="components.php">Components</a>
      <a href="preparationlist.php">Preparation List</a>
      <a href="training.php">Training</a>
      <b><a href="account.php" id = "selected">Account</a></b>
      <a href="logout.php" id= "bb">Log out</a>
     </nav>
    </div>

   <div class="item3">
    <div class="third">
     <b><h3>Change Account Information</h3></b>
    </div>
   </div>

  <div class="item5">
   <div class="fifth">
    <div class = 'BlackBox' id ="centre_BlackBox">
     <div class = 'move-Content' id = "move-Content">
      <h2>Reset Password</h2>
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
         <p>New Password</p>
         <input disabled id="input" type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
         <span class="help-block"><?php echo $new_password_err; ?></span>
        </div>
         <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
          <p>Confirm Password</p>
          <input disabled id="input" type="password" name="confirm_password" class="form-control">
          <span class="help-block"><?php echo $confirm_password_err; ?></span>
         </div>
         <br>
          <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Submit">
           <a id="link" class="btn-link" href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>
   </div>

 <div class="item6">
  <div class="sixth">
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
