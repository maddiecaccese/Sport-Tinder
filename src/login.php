<!DOCTYPE html>

<?php
/**
 * @author Alex Nguyen and Juan Eckert
 */

ini_set('display_errors', 'On');
include_once("db_connect.php");
include_once("utils.php");
print_r($_POST);
?>

<HTML>

<HEAD>You are being logged in.</HEAD>

<!-- <h2>test</h2> -->

<BODY>
   

    <?php
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    // print("Get here1");
    $res = checkUser($db, $uname, $psw);
    // print("Get here2");
    if($res >= 0) {
        printf("<h3>Login successfully</h3>");
        session_start();
        $_SESSION['userId'] = $res;
        print("This is userid: ".$res);
        print_r($_SESSION);
        header("Location: ./dash/dash.php");
        // header("Location: ./card.php?userId=$res");
        // header("Location: ./card.php");
    } else if ($res == -1) {
        printf("<h3>No user login found!</h3>");
    } else if ($res == -2) {
        printf("<h3>Login successfully but have to verify</h3>");
    } else if ($res == -3) {
        printf("<h3>User found but wrong password!</h3>");
    } else {
        printf("<h3>Error!</h3>");
    }
    ?>

</BODY>

</HTML>