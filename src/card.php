<?php 
    session_start();
    // echo 'Welcome!';
    $_SESSION['userId'] = 2;
    require_once('db_connect.php');
    require('utils.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Card</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
</head>

<body>
    <div class="card" style="width: 500px;">
        <div class = "container">
            <?php 

            function print_card($pid, $name, $gender, $sports, $isRequesting) {
                print("<div class = 'row'>
                            <div class = 'col-sm'>
                                <div class='card-body'>
                                    <h4 class='card-title'>$name</h4>
                                    <h6 class='text-muted card-subtitle mb-2'>$gender</h6>
                                    <p class='card-text'>$sports</p>
                                </div>
                            </div>
                            <div class = 'col-sm' style='display: flex; justify-content: center; align-items: center;'>");
                                if ($isRequesting) {
                                    print("<form action='request.php' name='$pid' method='POST'>
                                                <input type='hidden' name='pid' value='$pid' />
                                                <input type='radio' id='practice' name='matchType' value='practice'>
                                                <label for='practice'>Practice</label>
                                                <input type='radio' id='match' name='matchType' value='match'>
                                                <label for='match'>Match</label>
                                                <br>
                                                <button type='submit' name='request'>Send Request</button>
                                            </form>");
                                } else {
                                    print("<form action='accept.php' name='$pid' method='POST'>
                                                <input type='hidden' name='pid' value='$pid' />
                                                <button type='submit' name='accept'>Accept</button>
                                                <button type='submit' name='decline'>Decline</button>
                                            </form>");
                                }
                print("</div>
                    </div>");
            }
            
            $res = getAllPlayer($db, $_SESSION['userId']);

            if (!$res) {
                print("No resource!\n");
            }
            
            if ($res->rowCount() > 0) {
                while ($row = $res->fetch()) {
                    $isRequesting = $row['requesting'] == 'YES';
                    print_card($row['pid'], $row['name'], $row['sex'], $row['sports'], $isRequesting);
                }
            }
            ?>
        </div>
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>