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
<header>
  <h2>CADemia</h2>
</header>

<section>
  <nav>
    <ul>
      <form action="searchtutor.php" method="POST">
      <h2>Search Tutor</h2>
            <div class="form-group ">
               <input style="background-color:#b1d0b1; text-align:center;"
                type="text" placeholder="Input Subject" name="username" id="username" required>
             <center> 
                 <p> <span id="usernameLoading"></span></p>
                 <p><span text-align="center" id="usernameResult"></span></p>
                </center> 
            </div>
            
            <div class="form-group">           
               
                <?php
                    require_once "config.php";
                    $reg=0;
                    if(isset($_POST)& !empty($_POST) ){
    
                    $username=mysqli_real_escape_string($link, $_POST['username']);
                    $sql="SELECT * FROM users WHERE subject='$username'";
                    $result=mysqli_query($link,$sql);
                    $count=mysqli_num_rows($result);
    
                    if($count==0){
                        echo '<div>No tutors available for <b>'.$username.'</b></div>';
                        $reg=0;
                                }else{
                        $reg=1;
                                    }      
                                         }
                ?>
            </div>
            
           <div class="form-group">
                <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="search">
            </div>
            
             <br><br>          

        </form>
        <a href="homepage.php">Back to Home</a>
    </ul>
  </nav>
  
  <article>

<?php
if(isset($_POST)& !empty($_POST) & $reg==1){
$result = mysqli_query($link,"SELECT * FROM users WHERE subject='$username'");

echo "<table border='0' style='width:40%'>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>Username: " . $row['username'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Subject: " . $row['subject'] . "</td>";
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
}
?>
</form>
  </article>
</section>

</body>
</html>