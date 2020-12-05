<!-- Author: Maddie Caccese !-->
<?php   
        include_once("db_connect.php");
	session_start();
	//test code used before session variable was implemented in login
	// $_SESSION['userId'] = 2;
	$userId = $_SESSION['userId'];
	//print_r($_POST); //prints what user submitted (recursive printing)
?>
<!DOCTYPE html>
<HTML>
<HEAD><TITLE>Added New Team</TITLE></HEAD>
<BODY style="background-color:#A8EBED;">
<H2 style="text-align:center;">Adding New Team...</H2>
<!-- php code section below to add a new row to MYSQL table team -->
<?php
//query to find max team id
$query = "SELECT MAX(tid) FROM team;";
$result = $db->query($query);
$tid = -1;

if($result != FALSE){
	$row = $result->fetch(); //gets the row of the first found data
	// make this new team's tid one higher that the max team id already existing
	$tid = $row['MAX(tid)'] + 1;
}

$teamname = $_POST["teamname"];
$avg_birthyear=0;
//query to get info from user who is logged in (automatically captain)
$q1="SELECT * FROM player WHERE pid=$userId;";
$r1 = $db->query($q1);
$row = $r1->fetch();
$birthyear1= $row['birthyear']; //captain birthyear
$captainSex = $row['sex']; //captain sex
$teamSex = $captainSex;
//query to get information of selected players
$qStr = "SELECT * FROM temp_team NATURAL JOIN player;";
//returns PDOStatement object; $db from db_connect script
$qRes = $db->query($qStr);
if($qRes != FALSE){
        while($row = $qRes->fetch()){ //for each row in $qRes ... iterator-like
                $pid = $row['pid'];
                $name = $row['name'];
                $birthyear = $row['birthyear'];
                $sex = $row['sex'];
                $sports = $row['sports'];
                $preferred_time = $row['preferred_time'];
		$rating = $row['rating'];
		//figure out if the team is Male, Female, or Unisex
		if($teamSex == "M" AND $sex == "M"){
			$teamSex = "Male";
		}
		else if($teamSex == "F" AND $sex == "F"){
			$teamSex = "Female";
		}
		else{
			$teamSex = "Unisex";
		}
		//add up birthyears
		$avg_birthyear += $birthyear;
	}
	$dataLength=$qRes->rowCount();
	//get average of birthyears
	$avg_birthyear=($avg_birthyear + $birthyear1)/($dataLength + 1);
}
else{
	print "Failed.";
}
//get entered information from the form
$sport = $_POST["sport"];
$current_location = $_POST["current_location"];
$preferred_location = $_POST["preferred_location"];
$preferred_time = $_POST["preferred_time"];
$rating = 0;
$is_banned = 0;
$elo = 0;
$captain_id=$userId;
//query to insert new team into team table
$q1 = "INSERT INTO team VALUE($tid, '$teamname', $avg_birthyear, '$teamSex', '$sport', '$current_location', '$preferred_location', '$preferred_time', $rating, $is_banned, $elo, $captain_id);";
$r1 = $db->query($q1);

if($r1 != FALSE){
        print "<H2 style='text-align:center;'>Successfully added $teamName as new team</H2>\n";
	//query to clear temp_team table so that the next new team will have the actual chosen players
	$removeQuery = "DELETE FROM temp_team;";
	$removeResult = $db->query($removeQuery);
	//test code
	/**if($removeResult != FALSE){
		print "Temp_team tables cleared.";
	}
	else{
		print "THIS FAILED.";
	}**/
}
else{
        print "<H2>Unable to add $teamName as new team</H2>\n";
}
?>

</BODY>
</HTML>
