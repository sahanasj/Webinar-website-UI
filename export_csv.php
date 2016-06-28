<?php
    // mysql database connection details
    $host = "localhost";
    $username = "root";
    $password = "pass";
    $dbname = "webinar";
    $file = 'webinar_data';

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));

    // fetch mysql table rows
    $headers = '';
    $sql = "SELECT * from webinar_users;";
    $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen($file."_".date("d-m-Y",time()).'.'.'csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }

    fclose($fp);
?>
