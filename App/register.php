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
$email = $fname = $lname = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT employee_id FROM employee WHERE employee_email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                    $fname = trim($_POST["fname"]);
                    $lname = trim($_POST["lname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO employee (employee_fname,employee_lname, employee_email, employee_password) VALUES (?,?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss",$param_fname,$param_lname, $param_email, $param_password);

            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fname = $fname;
            $param_lname = $lname;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Register</title>
 <link href='CSS/register.css' rel='stylesheet' type='text/css'>
 <link  rel='stylesheet' href='CSS/menu.css' type='text/css'>
 <link rel="icon" href="media/favicon/favicon.ico" sizes="16x16" type="image/png">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
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
 <a href="login.php">Login</a>
 <b><a href="register.php" id = "selected">Register</a></b>
 <a href="index.html">Home</a>
 </nav>
 </div>

<div class="item3">
 <div class = 'BlackBox' id ="centre_BlackBox">
 <div class ="container">
 <div class = "A" id = "picture">
 <img src="Media/Logo.jpg" width="350" height="350" class = "img-center">
 </div>
 <h2>Sign Up</h2>
 <p>Please fill in this form to create an account.</p>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

 <div class = 'B'>
 <div class="form-group">
 <p1>First Name</p1>
 <input disabled type="text" id="input" name="fname" class="form-control" value="<?php echo $fname; ?>">
 </div>
 <div class="form-group">
 <p1>Last Name</p1>
 <input disabled type="text" id="input" name="lname" class="form-control" value="<?php echo $lname; ?>">
 </div>
 <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
 <p1>Email</p1>
 <input disabled type="text" id="input" name="email" class="form-control" value="<?php echo $email; ?>">
 <span class="help-block"><?php echo $email_err; ?></span>
 </div>
 </div>

 <div class="C">
 <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
 <p1>Password</p1>
 <input disabled type="password" id="input" name="password" class="form-control" value="<?php echo $password; ?>">
 <span class="help-block"><?php echo $password_err; ?></span>
 </div>
 <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
 <p1>Confirm Password</p1>
 <input disabled type="password" id="input" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
 <span class="help-block"><?php echo $confirm_password_err; ?></span>
 </div>
 <div class="form-group" id = "center_buttons">
 <input disabled type="submit" class="btn" value="Register">
 <input disabled type="reset" class="btn" value="Clear" id="clear">
 </div>
 <p>Already have an account? <a href="login.php">Login here</a>.</p>
 <p><a href="index.html">Go back</a></p>
 </div>
 </form>
 </div>
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
