<?php

require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "username error";
    } else{

        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                    echo '<script>alert("This username is already taken.")</script>';
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo '<script>alert("Something went wrong. Please try again later.")</script>';
            }

            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
         $password_err = "password error";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if($password != $confirm_password){
            $confirm_password_err = "Password did not match.";
            echo '<script>alert("Password did not match.")</script>';
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
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
<h1 style="font-size:300%;"><br><br><br>Register<br><br></h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input style="background-color:#b1d0b1" type="text" placeholder="Username" name="username" class="form-control" value="<?php echo $username; ?>" required>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input style="background-color:#b1d0b1" type="password" placeholder="Password" name="password" class="form-control" value="<?php echo $password; ?>" required>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input style="background-color:#b1d0b1" type="password" placeholder="Confirm Password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required>
            </div>
            <br><br>
            <div class="form-group">
                <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
</div>
<br>
Already have an account? <a href="index.php">Login</a>
</center>  
</body>
</html>