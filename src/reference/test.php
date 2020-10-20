<?php 
	include_once("db_connect.php");

	printf("Database connected \n");

	$string = "SELECT * FROM t1;";
	$string2 = "SHOW database;";

	$res = $db->query($string);
	if($res != FALSE) {
		printf("rows = %d\n", $res->rowCount());
	} else {
	printf("not!");
}

?>
