
<!DOCTYPE html>
<?php
include_once("db_connect.php");

print_r($_POST);
?>


<html>

<head><title>This is another titan page !</title></head>
<body>

<h2>Added new titans</h2>

<?php

$id = $_POST['id'];
$name = $_POST['power'];
$planet = $_POST['planet'];
$power = $_POST['power'];

$sql1 = "INSERT INTO t1 VALUE($id, '$name');"; // Q: Will some variable be evaluated to actual name?
$sql2 = "INSERT INTO t2 (id, planet, power) VALUE ($id, '$planet', '$power');";
printf("sq1 is %s<br>sq2 is %s<br>", $sql1, $sql2);

$res1 = $db->query($sql1);
$res2 = $db->query($sql2);

if(!$res1 && !$res2){
	printf("successfully added");

} else{ 
	printf("<h2>NO data was added! Use NOSQL instead!</h2>");
}


?>

<p><a href = "titan.php"> Back to titan table!</a></p>

</body>

</html>
