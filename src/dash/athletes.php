<?php

    //getAthletes
    //gets a List of team/Players
    //Angel Vergara and Alex Nguyen
    function getAthletes($db, $pid, $type){
 
        if($type == 1){
            $q1 = "SELECT * FROM team";
        
            $r1 = $db->query($q1);
        
            //print "$q1\n";
        
            if($r1 == FALSE){ 
                print "<H1>DATABASE ERROR</H1>";
            }
            else{
                while($row = $r1->fetch()) {
                    //class of tiles to edit css later
                    $name2 = $row['teamname'];
                    $id = $row['tid'];
                    if($id != $pid){
                        print "<div class='tile'> <img src='prof.png' width='20' height='20'/>$name2</div>\n";
                    }
                }
            }
        }
        else{
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
                    $id = $row['pid'];
                    if($id != $pid){
                        print "<div class='tile'> <img src='prof.png' width='20' height='20'/>$name2</div>\n";
                    }
                /* print(`<div class="card" style="width: 500px;">
                    <div class = "container">
                        <div class = "row">
                            <div class = "col-sm">
                                <div class="card-body">
                                    <h4 class="card-title">NAME</h4>
                                    <h6 class="text-muted card-subtitle mb-2">SPORT</h6>
                                    <p class="card-text">Time</p>
                                </div>
                            </div>
                            <div class = "col-sm" style="display: flex; justify-content: center; align-items: center;">
                                <form>
                                    <button type="submit" name="accept">Accept</button>
                                    <button type="submit" name="decline">Decline</button>
                                </form>
                            </div>
                        </div>
                    </div>`); */
            }
        }
        }
 
    }
?>
