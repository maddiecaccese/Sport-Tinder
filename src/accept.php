<?php 
/**
 * @Author: Alex Nguyen
 * accept.php
 * This class implement a form (accept/ decline button) that interact with the accept/ decline relation in the database.
 */
include_once("db_connect.php");
include('./util.php');

print_r($_POST);

// if (isset($_POST['accept'])) {
//     print("Accept butotn clicked!");
// } else {
//     print("Decline button clicked");
// }

$accepterId = $_POST['accepterId'];
$recipientId = $_POST['recipientId'];
$matchType = $_POST['matchType'];
$accepted = isset($_POST['accept']);

acceptPlayer($db, $accepterId, $recipientId, $matchType, $accepted);

?>
