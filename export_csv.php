<?php
    // mysql database connection details
    $host = "localhost";
    $username = "root";
    $password = "pass";
    $dbname = "webinar";
    $file = 'webinar_user_details'."_".date("d-m-Y",time()).'.'.'csv';
    $fp = fopen('php://output', 'w');
    
    $conn = mysql_connect($host,$username,$password);
    mysql_select_db($dbname,$conn);

    // open connection to mysql database

    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='".$dbname."' AND TABLE_NAME='webinar_users';";
    $result = mysql_query($query);
    while ($row = mysql_fetch_row($result)) {
	$header[] = $row[0];
    }
    // Header info settings
    //header("Content-type: text/csv");
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=".$file);
    fputcsv($fp, $header);

    $num_column = count($header);

    // fetch mysql table rows
    $query = "SELECT * from webinar_users;";
    $result = mysql_query($query) or die("Selection Error " . mysql_error($connection));

    while($row = mysql_fetch_row($result))
    {
        fputcsv($fp, $row);
    }
    
exit;

?>
