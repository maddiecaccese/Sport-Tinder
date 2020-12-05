<!-- Author: Juan Eckert -->

<!DOCTYPE html>
<HTML>

<HEAD>
    <TITLE>Edit Profile</TITLE>
</HEAD>

<?php
session_start();

$userId = $_SESSION['userId'];
include_once("db_connect.php");

$str = "SELECT * FROM player WHERE pid=$userId;";
$res = $db->query($str);
$row = $res->fetch();

$name = $row['name'];
$birthyear = $row['birthyear'];
$sex = $row['sex'];
$sports = $row['sports'];
$address = $row['address'];
$current_location = $row['current_location'];
$preferred_time = $row['preferred_time'];

?>

<BODY style="background-color:#f2b476;"></BODY>
<!--4c1130-->

<center>
    <H2>Edit your profile</H2>

    Enter your information to edit your account!

    <FORM name="fmEditProfile" method="POST" action="editProfile.php">
        <b>What is your name? First and last!<br><input type="text" value="<?php print "$name"; ?>" name="name" placeholder="First and last name" required>
            </br>

            <br>
            Enter your birthyear: <br><input type="year" value="<?php print "$birthyear"; ?>" name="birthyear" placeholder="Format: yyyy" required>
            </br>

            <br>
            Choose your sex: <br>
            <select name="sex" value="<?php print "$sex"; ?>" placeholder="choose your sex" required>
                <option value=""></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            </br>

            <br>
            What sport do you want to play?<br><input type="text" value="<?php print "$sports"; ?>" name="sports" placeholder="Preferred Sport" required>
            </br>

            <br>
            Where are you located (State, City)?<br> <input type="text" name="address" value="<?php print "$address"; ?>" placeholder="Address" required>
            </br>

            <br>
            Where do you want to play (City)?<br> <input type="text" value="<?php print "$current_location"; ?>" name="current_location" placeholder="current location" required>
            <br>
            <br>
            When do you play?
            <br>
            <select name="preferred_time" value="morning" placeholder="select a time" required>
                <option value=""></option>
                <option value="morning">Morning</option>
                <option value="noon">Noon</option>
                <option value="afternoon">Afternoon</option>
                <option value="evening">Evening</option>
                <option value="night">Night</option>
            </select>
            </br>
            <br><br>
            <div>
                <input type="submit" style="background-color: #4c1130; color: white" value="Update Account" />
            </div>
    </form>
</center>
