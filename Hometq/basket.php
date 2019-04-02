<?php
session_start();
include("db.php");
$pagename="Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

if(isset($_POST['c_prodid'])){
	$delprodid=$_POST['c_prodid'];
	unset($_SESSION['basket'][$delprodid]);
	echo "<p>1 Item Removed From The Basket</p>";
}

 if(isset($_POST['h_prodid'])){

$newprodid = $_POST ['h_prodid'];
$reququantity = $_POST ['p_quantity'];


// echo "<p> Id of selected product: ".$newprodid."</p>";
// echo "<p> Quantity of selected product: ".$reququantity."</p>";

$_SESSION['basket'][$newprodid]=$reququantity;
echo "<p>1 item added";

}else {
	echo "<p>Current Basket Unchanged </p> <br>";
}

echo "<table>
  <tr>
    <th>Product Name</th>
    <th>Price</th> 
    <th>Selected Quantity</th>
	<th>Total Price</th>
	<th>Clear</th>
  </tr>";

   if(isset($_SESSION['basket'])){
	  
	 $totalprice=0;

	 foreach($_SESSION['basket'] as $index => $value){
	 	$SQL = "select prosName,prodPrice from product WHERE proId =".$index;
		$exeSQL= mysqli_query($conn, $SQL) or die (mysqli_error());
		$arrayp = mysqli_fetch_array($exeSQL);
		$subtotal = $arrayp['prodPrice'] * $value;
		$totalprice += $subtotal;

		echo " <tr>
				<td>".$arrayp['prosName']."</td>
				<td>".$arrayp['prodPrice']."</td>
				<td>".$value."</td>
				<td>".$subtotal."</td>
				<td>
				<form action=basket.php method=post>
				<input type=hidden name=c_prodid value=".$index.">
				<input type=submit value='REMOVE'>
				</form>
				</td>
			</tr>";
	   }
	   echo "
	  <tr>
	  <td colspan='3' ><b> Total</td>
	  <td>".$totalprice."</td>
	  <td></td>
	  </tr>";
	   
  }else{
	  echo"
	  <tr>
	  <td colspan='5'>
	  Please add items to the basket
	  </td>
	  </tr>";
  }
 
echo "</table> <br>";


echo "<a href=clearbasket.php>Clear Basket</a>";


if(isset($_SESSION['userid'])){
	echo "<p>To finalise your order <a href='checkout.php'>Checkout</a></p>";
}else{
	echo "<p>New hometeq customers: <a href='signup.php'>Sign up</a></p>";
	echo "<p>Returning hometeq customers: <a href='login.php'>Login</a></p>";
}

echo "<br>";
include("footfile.html"); //include head layout
echo "</body>";
?>