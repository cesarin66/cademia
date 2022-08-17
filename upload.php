<?php

session_start();

require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}


if(isset($_POST['save'])){

    $fileName=$_FILES['myfile']['name'];
    
    $destination='uploads/'.$fileName;
    
    $extension=pathinfo($fileName,PATHINFO_EXTENSION);
    
    $file=$_FILES['myfile']['tmp_name'];
    
    $size=$_FILES['myfile']['size'];
    $comments=trim($_POST['text']);
    
    if(!in_array($extension,['pdf','jpg','png','docx','txt'])){
        echo "wrong file format!";
    }elseif($_FILES['myfile']['size']>1000000){
        echo "file is too large!";
    }else{
        if(move_uploaded_file($file,$destination)){
            $sql_upload="INSERT INTO uploads(name,comment)
            VALUES('$fileName','$comments')";
            
            if(mysqli_query($link,$sql_upload)){
            }else{
                echo "failed to upload file";
            }
            
        }
    }
    
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
<form action="upload.php" method="post" enctype="multipart/form-data">
      <h2>Upload</h2>
            
            <div class="form-group">           
               <textarea style="background-color:#b1d0b1; resize: none;"  placeholder="Comment..." name="text" class="form-control" value="<?php echo $text; ?>" rows="10" cols="25"></textarea><br><br>
                <input type="file" name="myfile"><br><br>
               <button type="submit" name="save">Upload</button><br>
            </div>
            
             <br><br>          

        </form>
        
        
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
</form>
  </article>
</section>

</body>
</html>