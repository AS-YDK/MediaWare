<?php
    $dsn = "mysql:****; host=localhost";
    $user = "****";
    $dbpassword = "****";
    $pdo = new PDO($dsn,$user,$dbpassword,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $mail = $_POST["mail"];
    $password = $_POST["password"];

    $sql = 'select * from user where mail = "'.$mail.'";';
    $stmt = $pdo -> query($sql);
    $results = $stmt -> fetchAll();

    foreach ($results as $row){
        if($row['password'] == $password){
            echo '<div style="text-align: center;">
                ようこそ<strong>'.$row['name'].'</strong>さん！<br>
                <form action="main.php" method="POST">
                    <input type="hidden" name="user_name" value="'.$row['name'].'">
                    <input type="submit" value="続ける">
                </from>
                </div>';
            //header("Location:./index.php");
            break;
        }else{
            header("Location:./login.html");
        }
    }
?>