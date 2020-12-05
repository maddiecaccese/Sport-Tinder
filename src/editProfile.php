<!-- Author:  Juan Eckert -->
<!DOCTYPE html>
<HTML>
<BODY>

<?php
/**
 * @author Juan Eckert
 */
session_start();
$userId = $_SESSION['userId'];
include_once("db_connect.php");
//print_r($_POST);
?>

	

<?php
	$name = $_POST["name"];
	$birthyear = $_POST["birthyear"];
	$sex = $_POST["sex"];
	$sports = $_POST["sports"];
	$address = $_POST["address"];
	$current_location = $_POST["current_location"];
	$preferred_time = $_POST["preferred_time"];

	$qStr1 = "UPDATE player SET name='$name', birthyear=$birthyear, sex='$sex', sports='$sports', address= '$address', current_location='$current_location', preferred_time='$preferred_time' WHERE pid=$userId;";
	//printf("q1 = %s\n", $q1);

	$res1 = $db->query($qStr1);

	if($res1 != FALSE){
			print "<H2>Successfully edited your account!</H2>\n";
	}
	else{
			print "<H2>Sorry, we had trouble editing your account. Please try again.</H2>\n";
	}
?>

</BODY>
</HTML>
