<!DOCTYPE html>
<HTML>
<HEAD>
<!--A modification of the signup page for advanced search purposes. 
The original page by Alex Nguyen and Juan Eckert. Modifications by Angel Vergara-->
	<TITLE>Search</TITLE>
</HEAD>

<BODY style="background-color:#f2b476;"></BODY>
<!--4c1130-->
<center>
<H2>Search for other Athletes or Teams!!</H2>

<FORM name="findOppo" method="POST" action="dash.php">
	<b>Do you know them?<br><input type="text" name="name" placeholder="First name">
	</br>
	
	<br>
	Enter their general age: <br><input type="int" name="age">
	</br>
	
	<br>
	Rating? <br><input type="int" name="rating">
	</br>

	<br>
	Any sex?: <br>
	<select name="sex" placeholder="choose your sex">	
		<option value =""></option>
		<option value="M">Male</option>
		<option value="F">Female</option>
		<option value="O">Other</option>
	</select>
	</br>

	<br>
	What sport do should they play?<br><input type="text" name="sports" placeholder="Preferred Sport">
	</br>

	<br>
	Location?<br> <input type="text" name="location" placeholder="General Location">
    </br>
	
	<br><br>
	<div>
        <input
          type="submit"
          style="background-color: #4c1130; color: white"
          value="Search"
        />
	</div>
</form>
</center> 
