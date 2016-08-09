<?php

//Required files to send mail

require '/lib/PHPMailer/class.phpmailer.php';
require "/lib/PHPMailer/PHPMailerAutoload.php";

//confirm User mail

function AlertUser(){

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'onecloudc@gmail.com';
    $mail->Password = 'xxxxxx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;

    $mail->From = 'onecloudc@gmail.com';
    $mail->FromName = 'OneCloud Consulting';
    $mail->addAddress($_POST['email']);

    $mail->isHTML(true);

    $mail->Subject = '[OpenStack - Webinar] OneCloud Consulting: Registration confirmed!';
    $mail->Body    = 'Hello'.' '.$_POST['firstname'].' '.$_POST['lastname'].','."<br/>"."<br/>"."<b>Webinar Event scheduled on</b> :" .$_POST['timezone']."<br/>"."<br/>"."<img src=\"cid:logoimg\"/>"."<br/>"."<br/>"."<br/>"."<br/>".'Regards,'."<br/>".'<b>OneCloud Consulting Team</b>';

    $mail->AddEmbeddedImage("images/thank-you.png", 'logoimg');
    if(!$mail->send()) {
        echo 'Your registration failed, Please try again later!';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'Your registration has been successful! Your confirmation email is on its way, Please take a look.';
	header("Location: http://xx.xx.xx.xx:9999/thank-you.html");
    }
}
AlertUser();

function AlertAdmin(){


    $email = new PHPMailer;

    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Username = 'cloudunoconsulting@gmail.com';
    $email->Password = 'xxxxx';
    $email->SMTPSecure = 'tls';
    $email->Port = 25;

    $email->From = 'cloudunoconsulting@gmail.com';
    $email->FromName = 'OneCloud Consulting';
    $email->addAddress('demophp59@gmail.com');

    $email->isHTML(true);

    $email->Subject = '[OpenStack - Webinar] OneCloud Consulting: New Registration confirmed!';
    $email->Body    = 'Hi Admin,'."<br/>".'A new user registered successfully for an Virtual Event introducing OpenStack Webinar!'."<br/>"."<br/>".'<b>FirstName</b> :'.$_POST['firstname']."<br/>".'<b>LastName</b> :'.$_POST['lastname'].'<br/>'.'<b>Email Address</b> :'.$_POST['email']."<br/>".'<b>Company</b> :'.$_POST['company']."<br/>".'<b>JobTitle</b> :'.$_POST['jobtitle']."<br/>".'<b>Country</b> :'.$_POST['country']."<br/>".'<b>State</b> :'.$_POST['state']."<br/>".'<b>Phone Number</b> :'.$_POST['mobile']."<br/>".'<b>TimeZone</b> :'.$_POST['timezone']."<br/>"."<br/>"."<br/>"."<br/>".'Regards,'."<br/>".'OneCloud Consulting Team';
    if(!$email->send()) {
        echo 'New User registration failed, due to some technical error!';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'A User has been registered successfully!';
    }
}
AlertAdmin();



function RegisterUserToDatabase(){

                $servername = "localhost";
                $username = "root";
                $password = "pass";
                $dbname = "webinar";
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $company = $_POST['company'];
                $jobtitle = $_POST['jobtitle'];
                $country = $_POST['country'];
                $state = $_POST['state'];
                $mobile = $_POST['mobile'];
                $timezone = $_POST['timezone'];
                $identity  = $_POST['identity'];

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO webinar_users (firstname,lastname,email,company,jobtitle,country,state,phone_number,timezone,identity) VALUES('$firstname', '$lastname', '$email', '$company', '$jobtitle', '$country', '$state', '$mobile', '$timezone', '$identity')";

    if (mysqli_query($conn, $sql)) {
        $success = "New user record is created successfully ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql1= "INSERT INTO users_list (firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')";

    if (mysqli_query($conn, $sql1)) {
        $success = "New user record is created successfully ";
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    }

RegisterUserToDatabase()
?>

