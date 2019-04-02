<?php
session_start();
include("db.php");

$pagename="Your Sign Up Results”"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page


$fname =$_POST['fname'];
$sname =$_POST['sname'];
$address=$_POST['address'];
$postCode=$_POST['pcode'];
$telNo =$_POST['telno'];
$email =$_POST['email'];
$password =$_POST['password'];



//Inserting data to the USer table
$SQL ="INSERT INTO users(userFName,userSName,userAddress,userPostCode,userTelNo,userEmail,userPassword) VALUES('$fname','$sname','$address','$postCode','$telNo','$email','$password')";

$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());


include("footfile.html"); //include head layout
echo "</body>";
?>