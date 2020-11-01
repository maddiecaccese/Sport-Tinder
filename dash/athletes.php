<?php

    function getAthletes($db, $type){
 
        $q1 = "SELECT * FROM player";
        
        $r1 = $db->query($q1);
        
        //print "$q1\n";
        
        if($r1 == FALSE){ 
            print "<H1>DATABASE ERROR</H1>";
        }
        else{
            while($row = $r1->fetch()) {
                //class of tiles to edit css later
                $name2 = $row['name'];
                print "<div class='tile'> <img src='prof.png' width='20' height='20'/>$name2</div>\n";
            }
        }
 
    }
?>
