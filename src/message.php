<?php 

/**
 * @filename message.php this file contain implementation for the message functionality. 
 * 
 * @author Alex Nguyen
 * 
 */
session_start();
require_once('db_connect.php');
require('utils.php');
$_SESSION['chatReceiverId'] = 5;

// $_SESSION['userId'] = 2;
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Card</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Chat containers */
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

/* Darker chat container */
.darker {
  border-color: #ccc;
  background-color: #ddd;
}

/* Clear floats */
.container::after {
  content: "";
  clear: both;
  display: table;
}

/* Style images */
.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

/* Style the right image */
.container .right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

/* Style time text */
.time-right {
  float: right;
  color: #aaa;
}

/* Style time text */
.time-left {
  float: left;
  color: #999;
}
.sidenav {
  height: 100%;
  width: 400px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 400px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

    </style>

</head>

<body>

    <div class="sidenav">
        <!-- <p style = "color: #ffffff">Adam</p>
        <br>
        <p style = "color: #ffffff">John</p> -->

        <?php 
          function printPerson($pid, $name) {
            print("<a href='./message.php?chatReceiverId=$pid'>$name</a><br>");
          }
        
          $res = getAllPlayer($db, $_SESSION['userId']);
          if (!$res) {
            print("NO resources");
          }
          while($row = $res->fetch()) {
            printPerson($row['pid'], $row['name']);
          }
        
        ?>



      </div>

      <div class="main">

        <?php 
        
        function printMessage($senderId, $receiverId, $time, $message) {
            // if ($senderId == $_SESSION['userId'] && $receiverId == $_SESSION['chatReceiverId']) {
              if ($senderId == $_SESSION['userId'] && $receiverId == $_GET['chatReceiverId']) {
                print("<div class='container darker'>
                            <img src='./assets/img/ava.jpg' alt='Avatar' class='right' style='float: right;margin-left: 20px;margin-right:0;'>
                            <p>$message</p>
                            <span class='time-left'>$time</span>
                        </div>");
            } else if ($receiverId == $_SESSION['userId'] && $senderId == $_GET['chatReceiverId']) {
                print("<div class='container'>
                            <img src='./assets/img/ava2.jpg' alt='Avatar'>
                            <p>$message</p>
                            <span class='time-right'>$time</span>
                        </div>");
            }
        }
        
        // Checking for a POST request 
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $senderId = $_SESSION['userId']; 
            // $receiverId = $_SESSION['chatReceiverId']; 
            $receiverId = $_GET['chatReceiverId'];
            $message = $_POST['message'];
            if ($message !== '') {
                $res = putMessage($db, $senderId, $receiverId, $message);
            }
            // print("message.php");
        } 

        // $res = getMessages($db, $_SESSION['userId'], $_SESSION['chatReceiverId']);
        if ($_GET['chatReceiverId']) {
          $res = getMessages($db, $_SESSION['userId'], $_GET['chatReceiverId']);
          if($res) {
              while($row = $res->fetch()) {
                  $time = $row['time'];
                  $message = $row['message'];
                  printMessage($row['pid1'], $row['pid2'], $time, $message);
              }
          }
        }
        ?>
        <!-- Print the input box -->
        <?php 
        $rid = $_GET['chatReceiverId'];
        print("<form action='message.php?chatReceiverId=$rid' method='POST'>
                  <input id='btn-input' type='text' name='message' class='form-control input-sm' placeholder='Type your message here...' />
                  <span class='input-group-btn'>
                      <button class='btn btn-warning btn-sm' id='btn-chat' type='submit' name='submit'>Send</button>
                  </span>
              </form>");
        ?>
        
    </div>
    


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>