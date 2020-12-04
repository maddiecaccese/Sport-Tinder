<!DOCTYPE html>
<?php 
/**
 * @author Alex Nguyen
 */
ini_set('display_errors', 'On');
require_once('db_connect.php');
require('utils.php');
print_r($_POST);
?>

<html>
    <head>
        <title>After signup</title>
    </head>

    <body>

        <?php 
        // print("Gett herre origin");
        $res = registerUser($db, $_POST);

        if ($res) {
            printf("<h3>Your account is created, check your email to verify your new account</h3>");
        } else {
            printf("<h3>Unable to sign up!</h3>");
        }

        ?>


    </body>
</html>