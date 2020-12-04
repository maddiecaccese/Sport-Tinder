<?php
//By Angel Vergara 
//A profile dashboard
session_start();
include_once("db_connect.php");
include_once("bootstrap.php");
include_once("profile.php");
include_once("athletes.php");
include_once("filter.php");

//Angel Vergara
//Checks the if the user is a team captain and if they shuld see the captains dashboard

function getTeam($db, $id) {
    $q1 = "SELECT * FROM team WHERE captain_id=$id";
    
    $r1 = $db->query($q1);
    
    $row = $r1->fetch();
    
    //print("$q1\n");
    //print(gettype($_GET['team']) . "\n");
    //print(count($row) . "\n");
    
    if(count($row) > 0 and $_GET['team'] == "true"){
        return 1;
    }
    else {
        return 0;
    }

}

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
            
            <div id="msg" class='button'>
            Messages/Requests
            <?php getMessages($db, $_SESSION['userId'], getTeam($db, $_SESSION['userId']))?>
            </div>

            <a href=dash.php?team=false><div id='Switch' class='button'>
            Switch to Player
            </div></a>
            
            <a href=dash.php?team=true><div id='Switch2' class='button'>
            Switch to Captain
            </div></a>
            
            <div id='CreateTeam' class='button' >
            Create a Team
            </div>
            
            <div id='Search' class='button' >
            Search
            </div>

        </div>

        <div id='Teams' class='col-2'>
            <div class='container'>
            <?php //getAthletes($db, 2, 1); 
                search($db, getTeam($db, $_SESSION['userId']), $_SESSION['userId'], $_POST['name'], $_POST['location'], $_POST['sex'], $_POST['age'], $_POST['rating']);?>
            </div>

        </div>

        <div id='Profile' class='col' >
        <?php getProfile($db, $_SESSION['userId'], getTeam($db, $_SESSION['userId'])); ?>
        </div>
        
</div>

</body>

<script>
document.getElementById("CreateTeam").onclick = function () {
        location.href = "../addTeam.html";
    };
    
document.getElementById("Search").onclick = function () {
        location.href = "search.php";
    };
    
</script>

</html>
