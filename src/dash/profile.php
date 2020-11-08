<?php 

 function getProfile($db, $pid, $type){
 
    //check if getting team or player profile
    //similar code in each section due to small differences in the databases
    if($type == 1){
        $q1 = "SELECT * FROM team WHERE tid='$pid'";
        $r1 = $db->query($q1);
    
        //print "$q1\n";
        if($r1 == FALSE){
            print "<H1>DATABASE ERROR</H1>";
        }
        else{
            $row = $r1->fetch();
            $name = $row['teamname'];
            $sport = $row['sports'];
            print "<h2 id='athName'> $name play $sport </h2>";
        }
    }
    else{
    
        $q1 = "SELECT * FROM player WHERE tid='$pid'";
        if($r1 == FALSE){
            print "<H1>DATABASE ERROR</H1>";
        }
        else{
            $row = $r1->fetch();
            $name = $row['name'];
            $sport = $row['sport'];
            print "<h2 id='athName'> $name play $sport </h2>";
        }
        //print "$q1\n";
    }
    
    
 }

?>
