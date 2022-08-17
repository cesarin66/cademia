<?php
session_start();

require_once "config.php";
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>

<!DOCTYPE html>
<html>
<style>
* {
  box-sizing: border-box;
}



header {
  background-color: #8FBC8F;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: #dcdcdc;
}

nav {
  float: left;
  width: 30%;
  background: #8FBC8F;
  padding: 20px;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  float: left;
  padding: 20px;
  width: 60%;
  background-color: #b1d0b1;
}

section:after {
  content: "";
  display: table;
  clear: both;
}

@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
</style>
<body style="background-color:#8FBC8F;">
<script type="text/javascript">
        $('document').ready(function(){
            $('#myP').load('chatscript.php');
            setInterval(function(){setUpdates()}, 10000);

        });

        function setUpdates(){

            $('#myP').load('chatscript.php');
        }

    </script>
    <header>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <h2>CADemia</h2>
    </header>
<section>
  <nav>
    <ul>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h2>Chat</h2>
            <div class="form-group <?php echo (!empty($text_err)) ? 'has-error' : ''; ?>">
            <textarea style="background-color:#b1d0b1; resize: none;"  placeholder="Chat..." name="text" class="form-control" value="<?php echo $text; ?>" rows="20" cols="50" required></textarea>
            </div>
            <div class="form-group">           
               
                <?php
                
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                    require_once "config.php";
                    if(isset($_POST)& !empty($_POST) ){
    
                    $text = "";
                    $text_err = "";
                    
                
                        if(empty(trim($_POST["text"]))){
                            $text_err = "text error";
                        } else{
                                $text = trim($_POST["text"]);
                              }
                    
                        if(empty($text_err)){
                            
                            $sql = "INSERT INTO chat (text, sender) VALUES (?,?)";
                             
                            if($stmt = mysqli_prepare($link, $sql)){
                    
                                mysqli_stmt_bind_param($stmt, "ss", $param_text, $param_sender);
                                
                                $user = $_SESSION["username"];
                                $param_text = $text;
                                $param_sender = $user;
                    
                                if(mysqli_stmt_execute($stmt)){
                                    header("location: chat.php");
                                } else{
                                    echo '<script>alert("Something went wrong. Please try again later.")</script>';
                                }
                    
                                mysqli_stmt_close($stmt);
                        }
                    
                        mysqli_close($link);
                    }
                    }
                    }
                ?>
            </div>
            
           <div class="form-group">
                <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="Post">
            </div>
            
             <br><br>          

        </form>
        <a href="homepage.php">Back to Home</a>
    </ul>
    </nav>
  
  <article>
    <?php
    $result = mysqli_query($link,"SELECT * FROM chat ORDER BY time DESC");
    
    echo "<table border='0' style='width:40%'>";
    
    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td style='color:red;'>" . $row['sender'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $row['text'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . NULL . "</td>";
    echo "</tr>";
    }
    echo "</table>";
    
    mysqli_close($link);
    ?>
  </article>
</section>

</body>
</html>

