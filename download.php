<?php
session_start();

require_once "config.php";
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 $dlcond ="0";
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
      <form action="download.php" method="post" enctype="multipart/form-data">
      <h2>Download</h2>
            
            <div class="form-group">           
               <input style="background-color:#b1d0b1; text-align:center;"
                type="text" placeholder="File Number" name="username" id="username" required>
               <input style="background-color:#eef5ee" type="submit" class="btn btn-primary" value="Download">
            </div>
            
             <br><br>      

        </form>
        
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            require_once "config.php";
                    $reg=0;
                    if(isset($_POST)& !empty($_POST) ){
    
                    $username=mysqli_real_escape_string($link, $_POST['username']);
                    $sql="SELECT * FROM uploads WHERE id='$username'";
                    $result=mysqli_query($link,$sql);
                    $count=mysqli_num_rows($result);
    
                    if($count==0){
                        $reg=0;
                                }else{
                        $reg=1;
                                    }
                    if($reg==1){
                    $res = mysqli_query($link,"SELECT name FROM uploads WHERE id='$username'");
                    $rod = mysqli_fetch_array($res);
                    $filename = $rod['name'];
                    $dlcond ="1";
                        mysqli_close($link);
                    } else{
                        echo '<div>Invalid File Number.</div>';
                    }
                    }
          }
        ?>
        <a href="uploads/<?php echo $filename; ?>" download>Download</a>    <br><br>    
        <a href="homepage.php">Back to Home</a>
    </ul>
    </nav>
  
  <article>
    <?php
     $files = glob("uploads/*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
            echo "Filename: ".basename($image)."<br />"; // show only image name if you want to show full path then use this code // echo $image."<br />";
             echo '<img src="'.$image .'" alt="Random image" width="320" height="200"/>'."<br /><br />";
            } else {
                continue;
            }
          }
$result=mysqli_query($link,"SELECT * FROM uploads");

echo "<table border='0' style='width:40%'>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td style='color:red;'>Post Number: " . $row['id'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['comment'] . "</td>";
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

