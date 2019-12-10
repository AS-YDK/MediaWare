<?php
    $dsn = "mysql:dbname=****; host=localhost";
    $user = "****";
    $password = "****";
    $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $mail = $_POST["mail"];

    $sql = 'delete from user where "'.$mail.'";';
    $stmt = $pdo -> query($sql);

    header("Location: ./index.php") ;
?>