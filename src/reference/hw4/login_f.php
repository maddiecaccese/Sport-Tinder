<!DOCTYPE html>

<?php 
require_once("db_connect.php");
require("hw4utils.php");
// print_r($_POST);
?>

<html>
    <head>
        <title>After login</title>
    </head>


    <body>
        <h1>This is the page after login</h1>
        <?php 
        
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        // printf("Test here!!");
        $res = checkUser($db, $login, $pass);
        // printf("<h1>Testing</h1>");
        if($res == 1) {
            printf("<h3>Login successfully</h3>");
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

    </body>
</html>