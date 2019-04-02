<?php
session_start();

$pagename="Sign up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo '
<form action="login_process.php" method="post">
<table>
<tr>	<td>Email</td>	<td><input type="text" name="email" required></td></tr>
<tr>	<td>Password</td>	<td><input type="text" name="password" required></td></tr>
<tr> <td><input type="Submit" value="Login"></td>
<td><input type="reset" value="Clear"></td></tr>
</table>
</form>
';
include("footfile.html"); //include head layout
echo "</body>";
?>
