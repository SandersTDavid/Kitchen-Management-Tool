
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

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
                session_destroy();
                header("location: Account.php");
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link  rel='stylesheet' href='CSS/Account.css' type='text/css'>
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
                <li><a href="Components.html">Components</a></li>
                <li><a href="Preplist.html">Preparation List</a></li>
                <li><a href="Training.php">Training</a></li>
                <li id="selected"><b><a href="Account.php">Account</a></b></li>
                <li id= "bb"><a href="logout.php">Log out</a></li>
            </ul>
         </nav>
        </div>
         <div class="item3">
         <div class="third">
<p>change account info</p>
         </div>
         </div>

         <div class="item4">

         </div>

         <div class="item5">
         <div class="fifth">
           <div class="wrapper1">
             <div class = 'BlackBox' id ="centre_BlackBox">
             <div class = 'move-Content' id = "move-Content">

               <h2>Reset Password</h2>
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                   <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                       <p>New Password</p>
                       <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                       <span class="help-block"><?php echo $new_password_err; ?></span>
                   </div>
                   <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                       <p>Confirm Password</p>
                       <input type="password" name="confirm_password" class="form-control">
                       <span class="help-block"><?php echo $confirm_password_err; ?></span>
                   </div>
                   <div class="form-group">
                       <input type="submit" class="btn btn-primary" value="Submit">
                       <a class="btn btn-link" href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
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
<script>
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
</footer>

</html>
