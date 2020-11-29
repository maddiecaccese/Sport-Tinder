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

$accepterId = $_SESSION['userId'];
$recipientId = $_POST['pid'];
$matchType = $_POST['matchType'];
$accepted = isset($_POST['accept']);

$res = acceptPlayer($db, $accepterId, $recipientId, $matchType, $accepted);
if ($res){
    print("Query Successfully!");
} else {
    print("500: internal server error!");
}
?>
