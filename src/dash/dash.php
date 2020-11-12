<?php
include_once("db_connect.php");
include_once("bootstrap.php");
include_once("profile.php");
include_once("athletes.php");
?>

<html>
<head><title>Dashboard</title></head>
<link rel="stylesheet" href="dash.css">
<body>

<div id='Main' class='row'>

        <div id='Menu' class='col-2 '>
        
            <div class='button'>
            Teams
            </div>
            
            <div class='button'>
            Messages/Requests
            <?php getMessages($db, 1, 1)?>
            </div>

            <div>
            Events:
            <?php ?>
            </div>

        </div>

        <div id='Teams' class='col-2'>
            <div class='container'>
            <?php getAthletes($db, 2, 1); ?>
            </div>

        </div>

        <div id='Profile' class='col' >
        <?php getProfile($db, 1, 1); ?>
        </div>
        
</div>

</body>

</html>
