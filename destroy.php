<?php
    $dsn = "mysql:dbname=****; host=localhost";
    $user = "****";
    $password = "****";
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql = 'drop table data;';
    $stmt = $pdo -> query($sql);

    $sql = 'drop table user;';
    $stmt = $pdo -> query($sql);

    header("Location: ./index.php") ;
?>