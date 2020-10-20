<?php
$host = "ada.cc.gettysburg.edu";
$dbase = "f20_nguyvi01";
$user = "nguyvi01";
$pass = "nguyvi01";

try {
        $db = new PDO ("mysql:host=$host;dbname=$dbase", $user, $pass);
}
catch (PDOException $e) {
        die("ERROEE". $e->getMessage());
}

?>

