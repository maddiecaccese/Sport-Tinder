<?php

function checkUser ($db, $login, $pass) {
    $hash = md5($pass);
    
    $str = "SELECT login, passHash, ulogin
            FROM user
            LEFT JOIN unverified
            ON login = ulogin
            WHERE login = '$login';";
    
    $res = $db->query($str);
    $userRow = $res->fetch();
    if ($res->rowCount() < 1) {
        return -1;
    } else if ($userRow['ulogin'] == $userRow['login']) {
        return -2;
    } else if ($userRow['passHash'] != $hash) {
        return -3;
    } else {
        return 1;
    }
}

// In hw4utils.php, write a function, addUser, which takes five parameters, $db, $login, $pass, $bdate, 
// and $email and adds a new user to user table and user's login to unverified table.
function addUser ($db, $login, $pass, $bdate, $email) {
    $hash = md5($pass);
    
    $str1 = "INSERT INTO user 
            VALUES (
                '$login',
                '$hash',
                '$bdate',
                '$email'
            );";
    $str2 = "INSERT INTO unverified 
            VALUES (
                '$login'
            );";

    $db->query($str1);
    // printf("<h1>Executed query 1</h1>");
    $db->query($str2);
    // printf("<h1>Executed query 2</h1>");
}


function registerUser ($db, $input) {

    $login = $input['login'];
    $pass = $input['pass'];
    $bdate = $input['bdate'];
    $email = $input['email'];

    $str = "SELECT login
            FROM user
            WHERE login = '$login';";
    // printf($str);
    $res = $db->query($str);
    if ($res->rowCount() > 0) {
        return false;
    }
    addUser($db, $login, $pass, $bdate, $email);

    // Send VERIFICATION emails
    $msg = "<a href='http://www.cs.gettysburg.edu/~nguyvi01/cs360/hw4/verify.php?login=$login'>Click here to verify your email.</a>";
    $msg = wordwrap($msg,70);
    mail($email, "Account Verification", $msg);

    return true;
}

function verifyEmail($db, $userlogin) {
    $str = "SELECT ulogin
            FROM unverified
            WHERE ulogin = '$userlogin';";

    $res = $db->query($str);
    if ($res->rowCount() == 0) {
        return false;
    }

    $str = "DELETE
            FROM unverified
            WHERE ulogin = '$userlogin';";

    $db->query($str);
    return true;
}

/**
 * @Params:
 *      $db (PDO): The database 
 *      $accepterId (int):
 *      $recipientId (int):
 *      $type (String):
 *      $accepted (boolean): whether they accept or not
 * @Returns:
 *      (boolean): Whether the query has been executed successfully
 */
function acceptPlayer($db, $accepterId, $recipientId, $type, $accepted) {
    $str = "INSERT INTO matches 
            VALUES ($accepterId, $recipientId, $type, CURRENT_TIMESTAMP(), $accepted);";
    $res = $db->query($str);
    if (!$res) {
        return false;
    }
    return true;
}


/**
 * Get all players
 * @Params:
 *      $db (PDO): The database
 * @Returns:
 *      (PDO): A table
 */
function getAllPlayer($db) {
    $str = "SELECT * 
            FROM player;";
    $res = $db->query($str);
    return $res;
}




?>