<?php
session_start();
include("db.php");

$pagename="Order Confirmation";
//Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
//Call in stylesheet
echo "<title>".$pagename."</title>";
//display name of the page as window title\

echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//display random text

$currentdatetime=date('Y-m-d H:i:s');

$userId= $_SESSION['userid'];
$addSQL="insert into orders ( userId  , orderDateTime) values ('".$userId."','".$currentdatetime."')";


if($exeaddSQL=mysqli_query($conn, $addSQL))
{
	$maxSQL= "select orderNo from orders where userId=" .$userId;
	$exemaxSQL= mysqli_query($conn, $maxSQL);
	$arrayord=mysqli_fetch_array($exemaxSQL);

	$orderNo= $arrayord['orderNo'];
	echo "<p> Successful Order - Order Reference No : " .$orderNo;

	
	
	
	
echo "<table>
  <tr>
    <th>Product Name</th>
    <th>Price</th> 
    <th>Quantity</th>
	<th>Subtotal</th>
	
  </tr>";

   if(isset($_SESSION['basket'])){
	  
	 $totalprice=0;

	 foreach($_SESSION['basket'] as $index => $value){
	 	$SQL = "select prosName,prodPrice from product WHERE proId =".$index;
		$exeSQL= mysqli_query($conn, $SQL) or die (mysqli_error($conn));
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
				</form>
				</td>
			</tr>";
	   }
	   echo "
	  <tr>
	  <td colspan='3' ><b> ORDER TOTAL</td>
	  <td>".$totalprice."</td>
	  <td></td>
	  </tr>";
	  echo "</table> <br>";
	   
   }
	  $updateSQL= "update orders SET orderTotal =".$totalprice. " where orderNo=" .$orderNo;
	  $exeupdateSQL= mysqli_query($conn, $updateSQL) or die (mysqli_error($conn));
	  
	  echo  "<p>Logout and Leave the system: <a href='logout.php'>Logout</a></p>";
  
 
  }else{
	 echo "<p>Order is not finalized tray again <a href='checkout.php'>Checkout</a></p>";

}
unset($_SESSION['userid']);
session_destroy();

include("footfile.html");
//include head layout
echo "</body>";
?>