<?php

// code to process user's comment form to mail to myself

$email   = $_POST['tfEmail'];   // $from
$name    = $_POST['tfName'];    // $from
$content = $_POST['taContent'];

$to      = "nguyvi01@gettysburg.edu";
$subject = "Comment from $name";

$header  = "From: $name <$email>\r\n";

$result  = mail($to, $subject, $content, $header);

if ($result == FALSE) {
    echo "<P>Comment was not sent</P>\n";
}
else {
    echo "<P>Comment was sent successfully</P>\n";
}

?>

<HTML>
<HEAD>
<TITLE>Thank you for contacting us</TITLE>
</HEAD>

<BODY>
<H2>Thank you for contacting us!</H2>

<P>Your name: <?php echo $name;  ?></P>
<P>Your mail: <?php echo $email; ?></P>
<P>Content: <PRE><?php echo $content; ?></PRE></P>

</BODY>
</HTML>
