<?php
/**
 * @author Alex Nguyen.
 */


/**
 * @author Alex Nguyen.
 * Return the user id of the login user.
 */
function checkUser ($db, $login, $pass) {
    $hash = md5($pass);
    
    $str = "SELECT id, login, pass, ulogin
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
    } else if ($userRow['pass'] != $hash) {
        return -3;
    } else {
        print_r($userRow);
        return $userRow['id'];
    }
}

/**
 * @author Alex Nguyen.
 */
function addUser ($db, $login, $pass, $email, $name, $birthyear, $sex, $address, $sport) {
    $hash = md5($pass);
    
    $str1 = "INSERT INTO user 
            (login, pass, sport, email)
            VALUES (
                '$login',
                '$hash',
                '$sport',
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

    // Get id of the registered user
    $str3 = "SELECT id FROM user WHERE login='$login'";
    $res3 = $db->query($str3);
    if (!$res3) {
        print("error!");
        return -1;
    }
    $row = $res3->fetch();
    $id = $row['id'];
    // Push to the player table the information.
    $str4 = "INSERT INTO player (pid, name, birthyear, sex, sports, address)
            VALUES ($id, '$name', $birthyear, '$sex', '$sport', '$address');";
    $res4 = $db->query($str4);
    if (!$res4) {
        print("Cannot add to player table!");
        return -1;
    }
    print("Add successfully!");
    return true;
}

/**
 * @author Alex Nguyen.
 */
function registerUser ($db, $input) {
    print("Get here 1");
    $uname = $input['uname'];
    $psw = $input['psw'];
    $email = $input['email'];
    $name = $input['name'];
    $birthyear = $input['birthyear'];
    $sex = $input['sex'];
    $address = $input['address'];
    $sport = $input['sport'];

    $str = "SELECT login
            FROM user
            WHERE login = '$uname';";
    $res = $db->query($str);
    if ($res->rowCount() > 0) {
        print("username exist");
        return false;
    }
    // print("Get here 2");
    addUser($db, $uname, $psw, $email, $name, $birthyear, $sex, $address, $sport);
    // print("Get here 3");

    // Send VERIFICATION emails
    $msg = "<a href='http://www.cs.gettysburg.edu/~nguyvi01/cs360/project/src/verify.php?uname=$uname'>Click here to verify your email.</a>";
    $msg = wordwrap($msg,70);
    mail($email, "Account Verification", $msg);

    return true;
}

/**
 * Verify user email
 * @author Alex Nguyen.
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

    $res = $db->query($str);
    if (!$res) {
        return false;
    }
    return true;
}

/**
 * Accept player, add to the match database and remove the query from the request
 * database
 * @author Alex Nguyen.
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
 * @author Alex Nguyen.
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
 * @author Alex Nguyen.
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
 * @author Alex Nguyen.
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
 * @author Alex Nguyen.
 * 
 * @param $db The database from db connect.
 * @param $sender The id of the sender.
 * @param $receiver The id of the receiver.
 * @param $message The message that was sent.
 */
function putMessage($db, $sender, $receiver, $message) {
    $str = "INSERT INTO messages VALUES ($sender, $receiver, CURRENT_TIMESTAMP(), '$message');";
    $res = $db->query($str);

    if ($res) {
        return true;
    }
    print("Error adding messages to the database!");
    return false;
}

/**
 * @author Alex Nguyen.
 */
function getMessages($db, $senderId, $receiverId) {
    $str = "SELECT * FROM messages M1
            WHERE pid1 = $senderId AND pid2 = $receiverId
            UNION ALL
            SELECT * FROM messages M2
            WHERE pid1 = $receiverId AND pid2 = $senderId
            ORDER BY time;";
    // print("String: ".$str);
    $res = $db->query($str);
    if ($res) {
        return $res;
    }
    return NULL;
}

?>