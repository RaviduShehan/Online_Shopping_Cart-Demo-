<?php

//session start
session_start();

$pagename="Template"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>Sign Up</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>Sign Up</h4>"; //display name of the page on the web page

//display form
echo '
<form action="signup_process.php" method="post">
<table>
<tr>	<td>First Name</td>	<td><input type="text" name="fname" required></td></tr>
<tr>	<td>Last Name</td>	<td><input type="text" name="sname" required></td></tr>
<tr>	<td>Address</td>	<td><input type="text" name="address" required></td></tr>
<tr>	<td>Post Code</td>	<td><input type="number" name="pcode" required></td></tr>
<tr>	<td>Tel Number</td>	<td><input type="number" name="telno" required></td></tr>
<tr>	<td>Email</td>		<td><input type="email" name="email" required></td></tr>
<tr>	<td>Password</td>	<td><input type="password" name="password" required></td></tr>

<tr> <td><input type="Submit" value="Submit"></td>	<td><input type="reset" value="Clear"></td></tr>
</table>
</form>
';

include("footfile.html"); //include head layout
echo "</body>";
?>
