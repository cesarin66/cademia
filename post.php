<?php

session_start();

// Include config file
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$text = "";
$text_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
 
    //Validate username
    if(empty(trim($_POST["text"]))){
        $text_err = "text error";
    } else{
            $text = trim($_POST["text"]);
          }
          
    if(empty($text_err)){
        
        $sql = "INSERT INTO post (text, username, comment, comment_by) VALUES (?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "ssss", $param_text, $param_username,$param_comment,$param_comment_by);
            
            $user = $_SESSION["username"];
            $param_text = $text;
            $param_username = $user;
            $param_comment = "";
            $param_comment_by = "";

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
            } else{
                echo '<script>alert("Something went wrong. Please try again later.")</script>';
            }

            mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
}
?>
 
<!DOCTYPE html>
<html>
<body style="background-color:#8FBC8F;">
<center>
<div>
<h1 style="font-size:300%;color: #dcdcdc;">CADemia<br></h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <br>
            <div class="form-group <?php echo (!empty($text_err)) ? 'has-error' : ''; ?>">
            <textarea style="background-color:#b1d0b1; resize: none;"  placeholder="Post something..." name="text" class="form-control" value="<?php echo $text; ?>" rows="20" cols="50" required></textarea>
            </div>
            <br><br>
            <div class="form-group">
                <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="Post">
            </div>
        </form>
</div>
<br>
<a href="homepage.php">Back to Home</a>
</center>  
</body>
</html>