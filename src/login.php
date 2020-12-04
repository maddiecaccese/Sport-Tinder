<!DOCTYPE html>

<?php
/**
 * @author Alex Nguyen and Juan Eckert
 */
include_once("db_connect.php");
include_once("utils.php");
session_start();
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
        // session_start();
        $_SESSION['userId'] = $res;
        header("Location: ./dash/dash.php");
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