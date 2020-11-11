<!DOCTYPE html>

<?php
include_once("db_connect.php");
print_r($_POST);
?>

<HTML>
	<HEAD>Your account has been created.</HEAD>
<BODY>
	

<?php
	$name = $_POST["name"];
	$birthyear = $_POST["birthyear"];
	$sex = $_POST["sex"];
	$sports = $_POST["sports"];
	$tid = NULL;
	$address = $_POST["address"];
	$preferred_location = $_POST["preferred_location"];
	$preferred_time = $_POST["preferred_time"];
	$rating = 0;
	$is_banned = 0;
	$elo = 0;

	$qStr1 = "INSERT INTO player VALUE('$name', '$sex', '$sports', '$address', '$preferred_location', '$preferred_time', $rating, $is_banned, $elo);";
	printf("q1 = %s\n", $q1);

	$res1 = $db->query($qStr1);

	if($r1 != FALSE){
			print "<H2>Successfully created your account! Start searching for people to play with now!</H2>\n";
	}
	else{
			print "<H2>Sorry, we had trouble making your account. Please try again.</H2>\n";
	}
?>

</BODY>
</HTML>
