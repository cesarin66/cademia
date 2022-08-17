<?php
session_start();

require_once "config.php";
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<body style="background-color:#8FBC8F;">
<center>
<header>
<h1 style="font-size:300%;color: #dcdcdc;">CADemia<br><br></h1>
</header>
<h2>What is your strongest subject?</h2>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group ">
               <input style="background-color:#b1d0b1; text-align:center;"
                type="text" placeholder="Input Subject" name="username" id="username" required>
                 <p> <span id="usernameLoading"></span></p>
                 <p><span text-align="center" id="usernameResult"></span></p>
            </div>
            <div class="form-group">           
               
                <?php
                
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                    require_once "config.php";
                    if(isset($_POST)& !empty($_POST) ){
    
                    $username=mysqli_real_escape_string($link, $_POST['username']);
                    
                    $text = trim($_POST["text"]);
                            $user = $_SESSION["username"];
                            $sql = "UPDATE users SET subject=? WHERE username = '$user';";
                             
                            if($stmt = mysqli_prepare($link, $sql)){
                    
                                mysqli_stmt_bind_param($stmt, "s", $param_subject);
                                
                                $param_subject = $username;
                    
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
            </div>
            
           <div class="form-group">
                <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="Submit">
            </div>
            
             <br><br>          

        </form>
        <a href="homepage.php">Back to Home</a>
    
    
</center>

</body>
</html>

