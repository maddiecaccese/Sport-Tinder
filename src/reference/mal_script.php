<?php
include_once("db_connect.php");



for ($i = 0; $i < 1000; $i++) {
    $sql1 = "INSERT INTO contacts VALUE($i, 'example'.'$i'.'@gmail.com', '0975'.'$i2'.'298742');";
    $res = $db->query($sql1);
    if ($res) {
        print("Done!");
    }
}

?>

