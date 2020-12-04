<?php 
    //filter.php
    //Angel Vergara
    function search($db, $type, $pid, $name, $location, $sex, $age, $rating) {
    
        if($type == 1){
            $qName = "SELECT * FROM team WHERE ";
        }
        else{
            $qName = "SELECT * FROM player WHERE ";
        }
        
        if($name != NULL){
            if($type == 1){
                 $qName = $qName . "teamname LIKE '%$name%' AND ";
            }
            else{
                 $qName = $qName . "name LIKE '%$name%' AND ";
            }
        }
        
        if($location != NULL){
            $qName = $qName . "current_location='$location' AND ";
        }
        
        if($sex != NULL){
            if($type == 1) {
                if($sex == 'M'){
                    $sex = 'Male';
                }
                else if($sex == 'F'){
                    $sex = 'Female';
                }
                else if($sex == 'O'){
                    $sex = 'Unisex';
                }
                $qName = $qName . "sex='$sex' AND ";
            }
            else{
                $qName = $qName . "sex='$sex' AND ";
            }
        }
        
        if($age != NULL){
            if($type == 1){
                 $qName = $qName . "median_birthyear>=YEAR(CURDATE()) - $age - 5 AND median_birthyear<=YEAR(CURDATE()) + $age+5 AND ";
            }
            else{
                 $qName = $qName . "birthyear>=YEAR(CURDATE()) - $age-5 AND birthyear<=YEAR(CURDATE()) + $age + 5 AND ";
            }
        }
        
        if($rating != NULL){
             $qName = $qName . "rating<=($rating + 2) AND rating>=($rating - 2) AND ";
        }
        
        
        $qName = $qName . "sex IS NOT NULL";
        
        $r1 = $db->query($qName);
        //print($qName . "\n");
        if($r1 == FALSE){
            print("Nothing Found");
        }
        else{
            if($type == 1){
                while($row = $r1->fetch()) {
                    //class of tiles to edit css later
                    $name2 = $row['teamname'];
                    $id = $row['tid'];
                    if($id != $pid){
                        print "<div class='tile'> <img src='prof.png' width='20' height='20'/>$name2</div>\n";
                    }
                }
            }
            else{
                 while($row = $r1->fetch()) {
                    //class of tiles to edit css later
                    $name2 = $row['name'];
                    $id = $row['pid'];
                    if($id != $pid){
                        print "<div class='tile'> <img src='prof.png' width='20' height='20'/>$name2</div>\n";
                    }
                }
            }
    
        }
    }
    
?>

<!-- Testing HTML -->
<!DOCTYPE HTML>
<html>
<head></head>
<body>
<?php //search($db, 2, "Baby", "Gulf of California", NULL, NULL, 8); ?>
</body>
</html>
