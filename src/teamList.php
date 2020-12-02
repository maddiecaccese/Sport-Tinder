<!-- Author: Maddie Caccese --!>
<?php
        include_once("db_connect.php");
?>
<!DOCTYPE html>
<HTML>
<HEAD><TITLE>Team List</TITLE>
<STYLE>
table.center {
  margin-left: auto;
  margin-right: auto;
}
</STYLE></HEAD>
<BODY style="text-align:center;background-color:lightgray;">
<H2 style="text-align:center;">Team List</H2>

<TABLE class="center" border='1' cellspacing='0' cellpadding='5' style="background-color:#A8EBED;">

<!-- heading row-->
<TR>
<TH>Team Name</TH> <TH>Average Birthyear</TH> <TH>Sex</TH> <TH>Sports</TH> <TH>Preferred Location</TH><TH>Preferred Time</TH><TH>Rating</TH><TH>Request to Join Team</TH>
</TR>

<?php
//query to access all teams
$qStr = "SELECT * FROM team;";
$qRes = $db->query($qStr);

if($qRes != FALSE){
        while($row = $qRes->fetch()){ //for each row in $qRes ... iterator-like
                $name = $row['teamname'];
                $avg_birthyear = $row['median_birthyear'];
                $sex = $row['sex'];
		$sports = $row['sports'];
		$preferred_location = $row['preferred_location'];
		$preferred_time = $row['preferred_time'];
		$rating = $row['rating'];

                print "<TR>";
                print "<TD>$name</TD>";
                print "<TD>$avg_birthyear</TD>";
                print "<TD>$sex</TD>";
		print "<TD>$sports</TD>";
		print "<TD>$preferred_location</TD>";
		print "<TD>$preferred_time</TD>";
		print "<TD>$rating</TD>";
		//did not have time to actually implement backend for join button, but I still left in action and method because they would be there if implemented
                print "<TD><INPUT type='button' style='background-color:black;color:white;' name='join' value='join' action='teamList.php?op=join' method='POST'/></TD>";
                print "</TR>\n";
        }
}
?>
</TABLE>
</BODY>
</HTML>
