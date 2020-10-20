<?php
include_once("db_connect.php");
ini_set("display_errors", 1);
?>

<!DOCTYPE html>

<head>

	<title>Attack on titans!</title>


</head>

<body>

<h1>welcome</h1>


<pre>

<?php 
$op = $_GET['op'];
printf("OPERATOR: ___%s___\n", $op);

print_r($_POST);


if($_GET['op'] == 'add') {
	$id =$_POST['id'];
	$name = $_POST['name'];
	$planet = $_POST['planet'];
	$power = $_POST['power'];
	

	$s1 = "INSERT INTO t1 VALUES($id, '$name');";
	$s2 = "INSERT INTO t2 VALUES($id, '$planet', '$power');";
	printf("Query 1: %s\nQuery 2: %s\n", $s1, $s2);

	$res1 = $db->query($s1);
	$res2 = $db->query($s2);

	if ($res1 && $res2) {
		print("Successfully added the item to the database!");
	} else {
		print("Unable to add the item to the database!");
	}

} else if ($_GET['op'] == 'del') {
	// Extract all checked id from the form
	foreach ($_POST['cbTitan'] as $id) {
		$s1 = "DELETE FROM table t1 WHERE id=$id;";
		$s2 = "DELETE FROM table t2 WHERE id=$id;";
		printf("Query: %s\n", $s1);
		$res1 = $db->query($s1);
		$res2 = $db->query($s2);

		if ($res1 && $res2) {
			print("Successfully removed the item to the database!\n");
		} else {
			print("Unable to remove the item to the database!\n");
		}

	}
}

?>

</pre>




<table border='1' cellspacing='0' cellpadding=5'>
<tr>
<th>Id</th><th>name</th><th>planet</th><th>power</th><th>Checkbox</th>
</tr>

<form name='fmDel' action="titan.php?op=add" method="POST">
	
	<tr>
		<td><input type="text" name="id" placeholder="ID"/></td>
		<td><input type="text" name="name" placeholder="NAME"/></td>
		<td><input type="text" name="planet" placeholder="PLANET"/></td>
		<td><input type="text" name="power" placeholder="POWER"/></td>
		<td><input type="submit" name="submit" value="Create hero"/></td>
	</tr>

</form>


<form name='fmDel' action="titan.php?op=del" method="POST">

<?php



$qStr = "SELECT * FROM t1 NATURAL JOIN t2;";
$qRes = $db->query($qStr);
printf("%s\n", $qRes->rowCount());
if (TRUE) {
	printf("<caption>The table has %d rows and %d columns</caption>\n", $qRes->rowCount(), $qRes->columnCount());

	while ($row = $qRes->fetch()) {
		$id =$row['id'];
		$name = $row['name'];
		$planet = $row['planet'];
		$power = $row['power'];
		print "<tr>";

		print "<td>$id</td>";
		print "<td>$name</td>";
		print "<td>$planet</td>";
		print "<td>$power</td>";
		print "<td><input type='checkbox' name='cbTitan[]' value='$id' /></td>";
		print "</tr>\n";


	}
	
	print "<tr><td colspan=5><input type='submit' value='Delete' /></td></tr>";

}
else {

	printf("Helllo db not work !!\n");
}
?>
</form>
</table>




</body>



</html>
