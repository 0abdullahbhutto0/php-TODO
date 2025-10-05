<?php 

    $db_server = "localhost:3308";
    $db_user = "root";
    $db_pass = "";
    $db_name = "usersdb";
    $conn = "";

    try{
       
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        echo "Goonected!<br><br>";

    }catch(mysqli_sql_exception){
        echo "Could not connect";
    }


?>