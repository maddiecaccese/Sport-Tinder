<?php 
/**
 * @Author: Alex Nguyen
 * accept.php
 * This class implement a form (accept/ decline button) that interact with the accept/ decline relation in the database.
 */
session_start();
include_once("db_connect.php");
include('./utils.php');

print_r($_POST);

// if (isset($_POST['accept'])) {
//     print("Accept butotn clicked!");
// } else {
//     print("Decline button clicked");
// }

// $accepterId = $_POST['accepterId'];
$accepterId = $_SESSION['userId'];
$recipientId = $_POST['pid'];
// $matchType = $_POST['matchType'];
$accepted = isset($_POST['accept']);

acceptPlayer($db, $accepterId, $recipientId, $matchType, $accepted);

?>
