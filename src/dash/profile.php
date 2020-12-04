<?php 


 //Angel Vergara
 //gets a player/team profile
 function getProfile($db, $pid, $type){
 
    //check if getting team or player profile
    //similar code in each section due to small differences in the databases
    if($type == 1){
        $q1 = "SELECT *, YEAR(CURDATE()) - median_birthyear AS age FROM team WHERE tid='$pid'";
        $r1 = $db->query($q1);
    
        //print "$q1\n";
        if($r1 == FALSE){
            print "<H1>DATABASE ERROR</H1>";
        }
        else{
            $row = $r1->fetch();
            $name = $row['teamname'];
            $sport = $row['sports'];
            $age = $row['age'];
            $Location = $row['current_location'];
            $rat = $row['rating'];
            
            
            print "<h2 id='athName'> $name play $sport </h2>";
            print "<h6 class='att'>Age:$age</h6>";
            print "<h6 class='att'>Location: $Location</h6>";
            print "<h6 class='att'>Rating: $rat</h6>";
        }
    }
    else{
    
        $q1 = "SELECT *, YEAR(CURDATE()) - median_birthyear AS age FROM player WHERE tid='$pid'";
        if($r1 == FALSE){
            print "<H1>DATABASE ERROR</H1>";
        }
        else{
            $row = $r1->fetch();
            $name = $row['name'];
            $sport = $row['sport'];
            $age = $row['age'];
            $Location = $row['current_location'];
            $rat = $row['rating'];
            
            
            print "<h2 id='athName'> $name play $sport </h2>";
            print "<h6 class='att'>Age:$age</h6>";
            print "<h6 class='att'>Location: $Location</h6>";
            print "<h6 class='att'>Rating: $rat</h6>";
        }
        //print "$q1\n";
    }
    }
    
    //Angel Vergara
    //gets a player/teams messages
    function getMessages($db, $pid, $type){
 
    //check if getting team or player profile
    //similar code in each section due to small differences in the databases
    if($type == 1){
        $q1 = "SELECT * FROM messages WHERE tid1='$pid' OR tid2='$pid' ORDER BY time DESC";
        $r1 = $db->query($q1);
    
        //print "$q1\n";
        if($r1 == FALSE){
            print "<H6>No Messages</H6>";
        }
        else{
            $row = $r1->fetch();
            $from = $row['pid1'];
            $to = $row['pid2'];
            $mes = $row['message'];
            if($from == $pid){
                $q3 = "SELECT * FROM team WHERE tid='$pid'";
                $r3 = $db->query($q3);
                $name = $row2['teamname'];
                
                print "<h6>$name: $mes</h6>";
            }
        }
    }
    else{
        $q1 = "SELECT * FROM messages WHERE pid1='$pid' OR pid2='$pid'  ORDER BY time DESC";
        if($r1 == FALSE){
            print "<H6>No Messages</H6>";
        }
        else{
            $row = $r1->fetch();
            $from = $row['pid1'];
            $to = $row['pid2'];
            $mes = $row['message'];
            if($from == $pid){
                $q3 = "SELECT * FROM player WHERE pid='$pid'";
                $r3 = $db->query($q3);
                $name = $row2['name'];
                
                print "<h6>$name: $mes</h6>";
            }
        }
        //print "$q1\n";
    }
    
 }

?>
