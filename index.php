<?php

session_start();
 

require_once "config.php";
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: homepage.php");
  exit;
}

$username = $password = "";
$username_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
             
                if(mysqli_stmt_num_rows($stmt) == 1){                    
 
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                        
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: homepage.php");
                        } else{
         
                            $password_err = "The password you entered was not valid.";
                            echo '<script>alert("Wrong password.")</script>';
                        }
                    }
                } else{
                   
                    $username_err = "No account found with that username.";
                    echo '<script>alert("Username does not exist.")</script>';
                }
            } else{
                echo '<script>alert("Something went wrong. Please try again later.")</script>';
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html>
<body style="background-color:#8FBC8F;">
<center>
<div>
<h1 style="font-size:500%; padding: 30px; text-align: center; color: #dcdcdc;"><br>CADemia<br></h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input style="background-color:#b1d0b1" type="text" placeholder="Username" name="username" class="form-control" value="<?php echo $username; ?>" required>
            </div>    
            <br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input style="background-color:#b1d0b1" type="password" placeholder="Password" name="password" class="form-control" required>
            </div>
            <br><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <br>
            Don't have an account? <a href="register.php">Register</a>
</form>
</div>
</center>   
</body>
</html>