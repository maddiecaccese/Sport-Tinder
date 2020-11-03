<!DOCTYPE html>
<?php
include_once("db_connect.php");
print_r($_POST); //prints what user submitted (recursive printing)
?>

<HTML>
<HEAD><TITLE>Added New Team</TITLE></HEAD>
<BODY>
<H2>Adding New Team...</H2>
<!-- php code section below to add a new row to MYSQL table team -->

<?php
$tid = $_POST["tid"];
$teamname = $_POST["teamname"];
$birthyear1 = $_POST["birthyear1"];
$birthyear2 = $_POST["birthyear2"];
$birthyear3 = $_POST["birthyear3"];
$birthyear4 = $_POST["birthyear4"];
$median_birthyear = ($birthyear1 + $birthyear2 + $birthyear3 + $birthyear4)/4;
$sex1 = $_POST["sex1"];
$sex2 = $_POST["sex2"];
$sex3 = $_POST["sex3"];
$sex4 = $_POST["sex4"];
$sex = "";
if($sex1 == "Male" & $sex2 == "Male" & $sex3 == "Male" & $sex4 == "Male"){
	$sex = "Male";
}
elseif($sex1 == "Female" & $sex2 == "Female" & $sex3 == "Female" & $sex4 == "Female"){
	$sex = "Female";
}
else{
	$sex = "Unisex";
}

$sport = $_POST["sport"];
$current_location = $_POST["current_location"];
$preferred_location = $_POST["preferred_location"];
$preferred_time = $_POST["preferred_time"];
$rating = 0;
$is_banned = 0;
$elo = 0;
$captain_id = $_POST["captain_id"];

$q1 = "INSERT INTO team VALUE($tid, '$teamname', $median_birthyear, '$sex', '$sport', '$current_location', '$preferred_location', '$preferred_time', $rating, $is_banned, $elo, $captain_id);";
printf("q1 = %s\n", $q1);

$r1 = $db->query($q1);

if($r1 != FALSE){
        print "<H2>Successfully added $teamName as new team</H2>\n";
}
else{
        print "<H2>Unable to add $teamName as new team</H2>\n";
}
?>

</BODY>
</HTML>
