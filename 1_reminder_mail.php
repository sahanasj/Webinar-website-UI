#!/usr/bin/php
<?php

/***** EDIT BELOW LINES *****/

$DB_Server = "localhost"; // MySQL Server
$DB_Username = "root"; // MySQL Username
$DB_Password = "pass"; // MySQL Password
$DB_DBName = "webinar"; // MySQL Database Name
$DB_TBLName = "users_list"; // MySQL Table Name

require '/lib/PHPMailer/class.phpmailer.php';
require '/lib/PHPMailer/PHPMailerAutoload.php';

$day1 = "Thu, July 14, 2016 3:00 - 4:00PM IST / 5:30 - 6:30PM SGT / 7:30 - 8:30PM AEST";

/***** DO NOT EDIT BELOW LINES *****/

// Create MySQL connection

// Create connection
$conn = new mysqli($DB_Server, $DB_Username, $DB_Password, $DB_DBName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute query
$sql = "SELECT * FROM $DB_TBLName LIMIT 0, 19";
$result = $conn->query($sql) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());


if ($result->num_rows > 0) {
    // Looping for each row
    while($row = $result->fetch_assoc()) {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'onecloudc@gmail.com';
        $mail->Password = 'xxxxx';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 25;

        $mail->From = 'onecloudc@gmail.com';
        $mail->FromName = 'OneCloud Consulting';
        $mail->clearAddresses();

        foreach($row as $email)
        {
           $mail->addAddress($email);
        }

        $mail->isHTML(true);

        $mail->Subject = '[Reminder/Webinar]: Virtual Event introducing OpenStack starts in 1 Day!';
        $mail->Body = 'Hello'.' '.$row['firstname'].' '.$row['lastname'].','."<br/>"."<br/>"."This is a reminder that Virtual Event introducing OpenStack will begin in 1 Day on:"."<br/>"."<br/>"."<b><font color='blue'>$day1</font></b>"."<br/>"."<br/>"."<img src=\"cid:logoimg\"/>"."<br/>"."<br/>"."<br/>"."<br/>"."<br/>".'Regards,'."<br/>".'<b>OneCloud Consulting Team</b>';

        $mail->AddEmbeddedImage("images/reminder.png", 'logoimg');


        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
         	}
         	else {
            echo 'Message has been sent';
        	}
    }
}
else {
echo "0 results";
}

$conn->close();

?>
