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
  width: 10%;
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
  width: 80%;
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
      <form>

<a href="homepage.php">Back to Home</a>
    </ul>
  </nav>
  
  <article>
<?php

$result = mysqli_query($link,"SELECT * FROM post ORDER BY created_at DESC");

echo "<table border='0' style='width:40%'>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>Post by: " . $row['username'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['created_at'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['text'] . "</td>";
echo "</tr>";
if(!empty($row['comment'])){
echo "<tr>";
echo "<td>" . NULL . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Comment by: " . $row['comment_by'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['comment'] . "</td>";
echo "</tr>";
}
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