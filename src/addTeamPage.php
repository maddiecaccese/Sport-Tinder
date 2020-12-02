<!-- Author: Maddie Caccese --!>
<?php   
        include_once("db_connect.php");
?>
<!DOCTYPE html>
<HTML>
<HEAD><TITLE>Add New Team</TITLE></HEAD>

<BODY style="text-align:center;background-color:#A8EBED;">
<H2 style="text-align:center;">Add a New Team</H2>

<!-- form for user to make team --!>
<FORM name="fmAddTeam" method="POST" action="addTeam.php">
	<div style="text-align:center;background-color:lightgray;border-style:dashed;border-color:black;">
	<br/>
	<b>
	Team Name: <input type="text" name="teamname" placeholder="name of team" />
	<br/>
	<br/>
	<!-- button to take you to playerList.php to chose players --!>
	<input type="button" style="background-color:black; color:white;" onclick="window.open('http://www.cs.gettysburg.edu/~caccma03/cs360/project/playerList.php')" value="Add Team Member" />
	<br/>
	<br/>
        Sport: <input type="text" name="sport" placeholder="sport" />
        <br />
	<br/>
        Current Location: <input type="text" name="current_location" placeholder="location of team" />
        <br />
	<br/>
        Preferred Location: <input type="text" name="preferred_location" placeholder="preferred location of team" />
        <br />
	<br/>
        Preferred Play Time: <input type="time" id="preferred_time" name="preferred_time" />
	</b>
	<br />
	<br/>
	</div>
	<br/>
	<br/>
	<div style="text-align:center;">
        <input type="submit" style="background-color:black; color:white;" value="Submit New Team"/>
        <input type="reset" style="background-color:black; color:white;" value="Clear Form"/>
	</div>
</FORM>
</BODY>
</HTML>
