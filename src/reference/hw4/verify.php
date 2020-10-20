<!DOCTYPE html>

<?php 
require("hw4utils.php");
require_once("db_connect.php");
// print_r($_GET);
?>

<html>

    <head>
        <title>Verify page</title>
    </head>

    <body>
        <h1>This is the verify page</h1>
        <?php 

        $login = $_GET['login'];

        $res = verifyEmail($db, $login);
        if($res) {
            printf("<h3>Successfully verified!</h3>");
        } else {
            printf("<h3>Error when verifying!</h3>");
        }

        ?>
    </body>
</html>

