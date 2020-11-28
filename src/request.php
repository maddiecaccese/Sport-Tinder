<?php 
/**
 * @Author: Alex Nguyen
 * request.php
 * 
 */
session_start();
include_once("db_connect.php");
include("utils.php");

print_r($_POST);

$senderId = $_SESSION['userId'];
$receiverId = $_POST['pid'];
$matchType = $_POST['matchType'];

requestPlayer($db, $senderId, $receiverId, $matchType);

?>
