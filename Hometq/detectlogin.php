<?php
//if the session user id $_SESSION['userid'] is set (i.e. if the user has logged in successfully)
if (isset($_SESSION['userid']))
{
//display first name and surname on the right hand-side, right under the navigation bar
echo "<p style='float:right;font-style: italic;'>".$_SESSION['fname']." ".$_SESSION['sname']." |" .$_SESSION['usertype']. "No: ".$_SESSION['userid'] ;
}
?>
