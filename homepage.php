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
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body style="background-color:#8FBC8F;">
<center>
<header>
<br><br>
  <h1 style="font-size:500%; font-family:'Times New Roman';color: #dcdcdc;"><b>CADemia</b><br></h1><br>
</header>

  <nav>
    <ul>
      <form>
<h2  style="font-family:'Times New Roman';"><?php echo htmlspecialchars($_SESSION["username"]); ?></h2> 
<br><br><br>
<table>
<tr>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Post Something" onclick="window.location.href='http://web.njit.edu/~cao29/CF/post.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="View Posts" onclick="window.location.href='http://web.njit.edu/~cao29/CF/viewpost.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Comment" onclick="window.location.href='http://web.njit.edu/~cao29/CF/comment.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Upload File" onclick="window.location.href='http://web.njit.edu/~cao29/CF/upload.php'" /></td>
</tr>
<tr>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Download File" onclick="window.location.href='http://web.njit.edu/~cao29/CF/download.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Search User" onclick="window.location.href='http://web.njit.edu/~cao29/CF/search.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Search Tutor" onclick="window.location.href='http://web.njit.edu/~cao29/CF/searchtutor.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Direct Message" onclick="window.location.href='http://web.njit.edu/~cao29/CF/message.php'" /></td>
</tr>
<tr>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="My Inbox" onclick="window.location.href='http://web.njit.edu/~cao29/CF/inbox.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Instant Chat" onclick="window.location.href='http://web.njit.edu/~cao29/CF/chat.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="I am a Tutor" onclick="window.location.href='http://web.njit.edu/~cao29/CF/tutor.php'" /></td>
<td align=center><input type="button" class="w3-button w3-darkgreen" style="font-size:200%; font-family:'Times New Roman';" value="Logout" onclick="window.location.href='http://web.njit.edu/~cao29/CF/logout.php'" /></td>
</tr>
</table>
</form>


    
</center>
</body>
</html>