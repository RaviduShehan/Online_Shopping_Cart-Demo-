<?php
session_start();
include("db.php");
$pagename="Your Login Results";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Capture the 2 inputs entered in the form (email and password) using the $_POST superglobal variable
//Assign these values to 2 new local variables $email and $password

$email = $_POST['email'];
$password = $_POST['password'];

//Display the content of these 2 variables to ensure that the values have been posted properly

//echo "<p>Entered email: ".$email ;
//echo "<p>Entered password: ".$password;

if (!empty($email) and !empty($password))
	{
	
		$selSQL="select * from users where userEmail='$email'";
	    //run SQL query
	    $exeSQL=mysqli_query($conn, $selSQL) or die (mysqli_error());
	
	    $arrayu=mysqli_fetch_array($exeSQL);
		
	if($arrayu['userEmail']!=$email){
		
		echo "<p><b> Login failed!</b></p>";
		echo "<p>The email you entered was not recognized";
		echo "<p>Go back to <a href='login.php'>login</a>";
	}
	
 else
	{
		
		if($arrayu['userPassword']!=$password){
			
		echo "<p><b> Login failed!</b></p>";
		echo "<p>The password you entered is not valid";
		echo "<p>Go back to <a href='login.php'>login</a>";
	}
		else{
		$_SESSION['userid'] = $arrayu['userId'];
		$_SESSION['usertype'] = $arrayu['userType'];
		$_SESSION['fname'] = $arrayu['userFName'];
		$_SESSION['sname'] = $arrayu['userSName'];
		
		
		if($arrayu['userType']= 'A'){
			
			$_SESSION['usertype'] =='Adminstrator';
			
		echo "<p><b> Login success!</b></p>";
		echo "<p>Hello, ".$_SESSION['fname']." ".$_SESSION['sname'];
		echo "<p> you have successfully logged in as a hometeq Adminstrator!";
		echo "<p>Continue shoppping for <a href='index.php'>Home Tech</a>";
		//echo "<p>view your <a href='basket.php'>Smart Basket</a>";
		}
		
   else	{
         if($arrayu['userType']= 'C'){
			 
			 $_SESSION['usertype'] =='Customer';
			 
			 echo "<p><b> Login success!</b></p>";
		echo "<p>Hello, ".$_SESSION['fname']." ".$_SESSION['sname'];
		echo "<p> you have successfully logged in as a hometeq Customer!";
		echo "<p>Continue shoppping for <a href='index.php'>Home Tech</a>";
		echo "<p>view your <a href='basket.php'>Smart Basket</a>";
		}

		}
		
	
}
	}
	}else{
	echo "<p> Your login form is incomplete<br>";
	echo "Make sure you provide all the required details</p>";
	echo "<p> Go back to <a href='login.php'>login</a>";
	}
	

include("footfile.html"); 

//include head layout

echo "</body>";
?>
