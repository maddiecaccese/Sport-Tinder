<?php
/**
 * @author Alex Nguyen.
 */


/**
 * 
 */
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

/**
 * Veryfy user email
 * 
 */
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
 * Accept player, add to the match database and remove the query from the request
 * database
 * 
 * @param $db (PDO): The database 
 * @param $accepterId (int):
 * @param $recipientId (int):
 * @param $type (String): Type of match
 * @param $accepted (boolean): whether they accept or not
 * @return (boolean): Whether the query has been executed successfully
 */
function acceptPlayer($db, $accepterId, $recipientId, $type, $accepted) {
    $accept = $accepted ? 1 : 0;
    $str = "INSERT INTO matches 
            VALUES ($accepterId, $recipientId, '$type', CURRENT_TIMESTAMP(), $accept);";
    $res = $db->query($str);
    print("SQL : ".$str."\n");
    if ($res) {
        print("success add to match!\n");
    } else {
        print("Not success add to match!\n");
    }

    $str2 = "DELETE FROM request WHERE senderId=$recipientId AND receiverId=$accepterId;";
    $res2 = $db->query($str2);
    print("SQL : ".$str2."\n");
    if ($res2) {
        print("success delete from request!\n");
    } else {
        print("Not success delete from request!\n");
    }

    if (!$res || !$res2) {
        return false;
    }
    return true;
}


/**
 * This method get the information of every player other than oneself. Plus one column
 * called 'requested', saying 'YES' if the current user have requested the querying 
 * player, 'NO' otherwise. Plus one column called 'pending' saying 'YES' if there is a
 * request sent to this user, and this user have to either accept or decline the match, 
 * saying 'NO' otherwise.
 * 
 * @param $db (PDO): The database
 * @return (PDO): A table
 */
function getAllPlayer($db, $userid) {
    $str = "SELECT * , (
                CASE WHEN 
                    EXISTS(
                        SELECT * 
                        FROM request
                        WHERE request.senderID = $userid AND player.pid = request.receiverId
                    ) THEN 'YES'
                    ELSE 'NO'
                END
            ) AS requested,
            (
                CASE WHEN
                    EXISTS (
                        SELECT *
                        FROM request
                        WHERE request.receiverId = $userid AND player.pid = request.senderId
                    ) THEN 'YES'
                    ELSE 'NO'
                END
            ) AS pending
            FROM player
            WHERE pid!=$userid;";
    $res = $db->query($str);
    if(!$res){
        print("No resources!");
        return;
    }
    return $res;
}

/**
 * Get the match type from the request table with the associated ids.
 * 
 * @param $db: PDO
 * @param $requesterId: The id of the requester.
 * @param $receiverId: The is of the receiver.
 * @return String: The match type that they request.
 */
function getMatchType($db, $requesterId, $receiverId) {
    $str = "SELECT matchType
            FROM request
            WHERE senderId = $requesterId AND receiverId = $receiverId";
    $res = $db->query($str);
    if (!$res) {
        return "Database error";
    }
    if ($res->rowCount() == 0) {
        return "No Result!";
    }
    // Otherwise, the query is guaranteed to have 1 row.
    $row = $res->fetch();
    return $row['matchType'];
}

/**
 * Request a match.
 * 
 * @param $db (PDO): The database
 * @return (PDO): A table
 */
function requestPlayer($db, $senderId, $receiverId, $matchType) {
    $str = "INSERT INTO request VALUES ($senderId, $receiverId, '$matchType', CURRENT_TIMESTAMP())";
    $res = $db->query($str);
    if(!$res){
        return false;
    }
    return true;
}

/**
 * Add the message to the database.
 * 
 * @param $db The database from db connect.
 * @param $sender The id of the sender.
 * @param $receiver The id of the receiver.
 * @param $message The message that was sent.
 */
function putMessage($db, $sender, $receiver, $message) {
    $str = "INSERT INTO messages VALUES ($sender, $receiver, CURRENT_TIMESTAMP(), $message);";
    $res = $db->query($str);

    if ($res) {
        return true;
    }
    print("Error adding messages to the database!");
    return false;
}


?>