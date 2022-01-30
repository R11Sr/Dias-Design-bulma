<!-- This is the creates the connection that is used to query the database. It is included in all PHP scripts  
need it -->

<?php
    $host = 'localhost';
    $username = 'dias_designs';
    $password = 'admin_root';
    $db = 'ecommerce';

    // this $conn variable is used in scripts that need it
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $username, $password);


?>