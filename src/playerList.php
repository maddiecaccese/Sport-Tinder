<!-- Author: Maddie Caccese !-->
<?php
	session_start();
	include_once("db_connect.php");
	//test code used before session variable was implemented in login
	//$_SESSION['userId'] = 2;
	$userId = $_SESSION['userId'];
?>
<!DOCTYPE html>
<HTML>
<HEAD><TITLE>Player List</TITLE>
<STYLE>
table.center {
  margin-left: auto; 
  margin-right: auto;
}
</STYLE></HEAD>
<BODY style="text-align:center;background-color:lightgray;">
<H2>Player List</H2>
<PRE>
<?php
	
$op = $_GET['op'];

if($op == "add"){
	//extract all checked pids from the form
        //and for each of the checked pids, we issue ADD command for the team
	foreach($_POST['cbPlayer'] as $pid){
		//query to put each chosen player into temp_team table
		$qStr1 = "INSERT INTO temp_team(pid) VALUE($pid);";
        	$r1 = $db->query($qStr1);
		//test code
        	/**if($r1 != FALSE){
                	print "<P>Added $pid to team</P>";
        	}
        	else{
                	print "<P>Not added to team</P>";
		}**/
        }
	print "<H2 style='text-align:center;'>Player(s) added to team</H2>";
	//this closes the window to bring the user back to the original form
	if(isset($_POST['submit'])){
		echo "<script>window.close();</script>";
	}
}
?>
</PRE>
<TABLE class="center" border='1' cellspacing='0' cellpadding='5' style="background-color:#A8EBED;">

<!-- heading row-->
<TR>
<TH>pid</TH> <TH>name</TH> <TH>birthyear</TH> <TH>sex</TH> <TH>sports</TH><TH>preferred time</TH><TH>rating</TH><TH>Add Player</TH>
</TR>
<FORM name="fmAdd" action="playerList.php?op=add" method="POST">
<?php
//query to get all players except the one that is logged in to display in table
$qStr = "SELECT * FROM player WHERE pid!=$userId;";
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

                print "<TR>";
                print "<TD>$pid</TD>";
                print "<TD>$name</TD>";
                print "<TD>$birthyear</TD>";
		print "<TD>$sex</TD>";
		print "<TD>$sports</TD>";
		print "<TD>$preferred_time</TD>";
		print "<TD>$rating</TD>";
                print "<TD><INPUT type='checkbox' name='cbPlayer[]' value='$pid'/></TD>";
		print "</TR>\n";
	}
	print "</TABLE> <br/>";
	print "<INPUT type='submit' style='background-color:black;color:white;' name='submit' value='Submit'/></FORM>";
}
else{
	print "Query failed.";
}
?>
</BODY>
</HTML>
