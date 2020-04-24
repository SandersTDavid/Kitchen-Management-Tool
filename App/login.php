<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: training.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$fname = $lname = $email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT employee_id, employee_fname, employee_lname, employee_email, employee_password FROM employee WHERE employee_email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s",$param_email);

            // Set parameters
            $param_email = $email;


            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $fname, $lname, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["fname"] = $fname;
                            $_SESSION["lname"] = $lname;

                            // Redirect user to welcome page
                            header("location: training.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_err = "No account found with that username.";
                }
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
<html lang="en">
<head>
  <link rel="icon" href="media/favicon/favicon.ico" sizes="16x16" type="image/png">
    <meta charset="UTF-8">
    <title>Login</title>
    <link href='CSS/Login.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
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
             <b><a href="login.php" id = "selected">Login</a></b>
                <a href="register.php">Register</a>
                <a href="index.html">Home</a>
         </nav>
       </div>

    <div class="item3">
      <div class = 'BlackBox' id ="centre_BlackBox">
        <div class ="sidebyside">
       <div class = "picture" id = "picture">

        <img src="Media/Logo.jpg" width="350" height="350" class = "img-center">
      </div>

      <div class = 'move-Content' id = "move-Content">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <p1>Email</p1>
                <input type="text" name="email" class="form-control" id="input" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <p1>Password</p1>
                <input type="password" name="password" class="form-control" id="input">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group" id = "center_buttons">
                <input type="submit" class="btn" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php" id="link">Sign up now</a>.</p>
            <p><a href="index.html" id="link">Go back</a></p>
        </form>
      </div>
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
