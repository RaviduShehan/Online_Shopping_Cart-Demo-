<?php
session_start();
include("db.php");
$pagename="Smart Basket";
//Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
//Call in stylesheet
echo "<title>".$pagename."</title>";
//display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

if(isset($_POST['del_prodid'])){
    $delprodid=$_POST['del_prodid'];
    unset($_SESSION['basket']);
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $newprodid=$_POST['h_prodid'];
    $reququantity= $_POST['p_quantity'];

    //echo $newprodid." and ".$reququantity;

    $_SESSION['basket'][$newprodid]=$reququantity;
   

    
}else{
    echo "Current basket unchanged";
}

if(isset($_SESSION['basket'])){

    echo "<table style='border: 2px'>";

    echo "<tr>";
    echo "<td>Name</td>";
    echo "<td>Price</td>";
    echo "<td>Quantity</td>";
    echo "<td>Subtotal</td>";
    echo "<td></td>";
    echo "</tr>";

    $total=0;
    foreach ($_SESSION['basket'] as $index => $value){
        $SQL = "select prosName,prodPrice from product WHERE proId =".$index;
        $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
        
        $arrayp=mysqli_fetch_array($exeSQL);
        
        
        echo "<tr>";
        echo "<td>".$arrayp['prosName']."</td>";
        echo "<td>$".$arrayp['prodPrice']."</td>";
        echo "<td>".$value."</td>";
        echo "<td>".$arrayp['prodPrice']*$value."</td>";
        $total=$total+$arrayp['prodPrice']*$value;
        echo "<td> <form action=basket.php method=post>
                <input type=hidden name=del_prodid value=".$index.">
                <button type=submit>REMOVE</button></form> </td>";
        echo "</tr>";

        echo "
        <tr>
        <td colspan='3' ><b> Total</td>
        <td>".$total."</td>
        <td></td>
        </tr>";
    

        echo "</table>";


    }
}

echo "<a href=clearbasket.php> Clear basket</a>";

echo "<p>New homteq customers:<a href=clearbasket.php>Sign up</a></p>";
echo "<p>Returning<a href=clearbasket.php> Login</a></p>";


include("footfile.html");
//include head layout
echo "</body>";
?>