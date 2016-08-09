<?php

function InviteesToDatabase(){
//Required files to send mail

require '/lib/PHPMailer/class.phpmailer.php';
require "/lib/PHPMailer/PHPMailerAutoload.php";


//function InviteesToDatabase(){ 
/***** EDIT BELOW LINES *****/

$DB_Server = "localhost"; // MySQL Server
$DB_Username = "root"; // MySQL Username
$DB_Password = "pass"; // MySQL Password
$DB_DBName = "webinar"; // MySQL Database Name
$DB_TBLName = "invitees_list"; // MySQL Table Name
$useremail = $_POST['useremail'];
$inviteesemail = $_POST['inputemail'];
$message = $_POST['inputmessage'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

// Create MySQL connection

// Create connection
$conn = new mysqli($DB_Server, $DB_Username, $DB_Password, $DB_DBName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO invitees_list (useremail, invitees_email, message) VALUES('$useremail', '$inviteesemail', '$message')";

if (mysqli_query($conn, $sql)) {
   $success = "New user record is created successfully ";
   header("Location: http://xx.xx.xx.xx:9999/thankyou.html");
// Execute query
   $sql1 = "SELECT * FROM $DB_TBLName";
   $result = $conn->query($sql1) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());

    if ($result->num_rows > 0) {
    // Looping for each row
    while($row = $result->fetch_assoc()) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'consultingonecloud@gmail.com';
        $mail->Password = 'xxxxx';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 25;

        $mail->From = 'consultingonecloud@gmail.com';
        $mail->FromName = 'OneCloud Consulting';
        $mail->clearAddresses();

        foreach($row as $inputemail)
        {
           $mail->addAddress($row['invitees_email']);
        }

        $mail->isHTML(true);
        $mail->Subject = 'You'."'".'re invited to attend this: Virtual Event introducing OpenStack For Beginners - APAC';
	$mail->Body = 'Hello'.','."<br/>"."<br/>".$useremail.','.' '.'has registered for <b>Virtual Event introducing OpenStack For Beginners - APAC</b> and wants to make sure you have all the information so you can register'."<br/>"."<br/>".'For more information and to register, click here: http://106.51.226.114:9999/Registration.html'."<br/>"."<br/>"."<br/>".'Message from a friend:'.' '.$message."<br/>"."<br/>"."<br/>".'Regards,'."<br/>".'<b>OneCloud Consulting Team</b>';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}
else {
echo "0 results";
}

}
else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$conn->close();
}
InviteesToDatabase()
?>
