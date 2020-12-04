<!DOCTYPE html>

<?php
include_once("db_connect.php");
include_once("utils.php");
session_start();
print_r($_POST);
?>

<HTML>

<HEAD>You are being logged in.</HEAD>

<h2>test</h2>

<BODY>
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    <?php
    
    echo

    $res = checkUser($db, $_POST["uname"], $_POST["psw"]);

    if ($res1 == 1) {
        print "<H2>Successfully logged in</H2>\n";
    } else if ($exists == -3){
      print "<h2>Your password is wrong<h2>\n";
    }
    else if ($exists == -2){
      print "<h2>Your account is unverified. CHeck your email.<h2>\n";
    }
    else {
      print "<h2>Your account does not exists.<h2>\n";
    }
    ?>

</BODY>

</HTML>