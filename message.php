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
  <h1 style="font-size:300%;color: #dcdcdc;">CADemia<br></h1>
</header>

      <form action="message.php" method="POST">
      <h2>Direct Message</h2>
            <div class="form-group ">
               <input style="background-color:#b1d0b1; text-align:center;"
                type="text" placeholder="Input Username" name="username" id="username" required>
                 <p> <span id="usernameLoading"></span></p>
                 <p><span text-align="center" id="usernameResult"></span></p>
            </div>
            <div class="form-group <?php echo (!empty($text_err)) ? 'has-error' : ''; ?>">
            <textarea style="background-color:#b1d0b1; resize: none;"  placeholder="Message..." name="text" class="form-control" value="<?php echo $text; ?>" rows="20" cols="50" required></textarea>
            </div>
            <div class="form-group">           
               
                <?php
                    require_once "config.php";
                    $reg=0;
                    if(isset($_POST)& !empty($_POST) ){
    
                    $username=mysqli_real_escape_string($link, $_POST['username']);
                    $sql="SELECT * FROM users WHERE username='$username'";
                    $result=mysqli_query($link,$sql);
                    $count=mysqli_num_rows($result);
    
                    if($count==0){
                        $reg=0;
                                }else{
                        $reg=1;
                                    }
                    $text = "";
                    $text_err = "";
                    
                    if($reg==1){
                     
                   
                        if(empty(trim($_POST["text"]))){
                            $text_err = "text error";
                        } else{
                                $text = trim($_POST["text"]);
                              }
                    
                        if(empty($text_err)){
                            
                            $sql = "INSERT INTO message (text, sender, reciever) VALUES (?,?,?)";
                             
                            if($stmt = mysqli_prepare($link, $sql)){
                    
                                mysqli_stmt_bind_param($stmt, "sss", $param_text, $param_sender, $param_reciever);
                                
                                $user = $_SESSION["username"];
                                $param_text = $text;
                                $param_sender = $user;
                                $param_reciever = $username;
                    
                                if(mysqli_stmt_execute($stmt)){
                                    header("location: index.php");
                                } else{
                                    echo '<script>alert("Something went wrong. Please try again later.")</script>';
                                }
                    
                                mysqli_stmt_close($stmt);
                        }
                    
                        mysqli_close($link);
                    }
                    } else{
                        echo '<div><b>'.$username.'</b> is not registered</div>';
                    }
                    }
                ?>
            </div>
            
           <div class="form-group">
                <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="Send">
            </div>
            
             <br><br>          

        </form>
        <a href="homepage.php">Back to Home</a>

</center>
</body>
</html>

