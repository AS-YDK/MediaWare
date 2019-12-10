<!doctype html>
<meta charset="utf-8">
<?php
    // 接続処理
    $dsn = "mysql:dbname=****; host=localhost";
    $user = "****";
    $dbpassword = "****";
    $pdo = new PDO($dsn,$user,$dbpassword,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    // テーブル作成
    $sql = "create table if not exists user(id int auto_increment primary key,mail varchar(100) unique,name varchar(32),password varchar(32));";
    $stmt = $pdo -> query($sql);

    $sql = "create table if not exists data(id int auto_increment primary key,date datetime default current_timestamp,file_name varchar(200));";
    $stmt = $pdo -> query($sql);
?>
<html>
    <head>
        <title>MediaWare</title>
        <style>            
            #register_login{
                float: right;
            }

            #notic{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="register_login">
            <a href="./register.html">会員登録</a>   <a href="./login.html">ログイン</a>
        </div>

        <div id="notic">
            <strong>コンテンツの閲覧にはログインが必要です</strong>
        </div>
    </body>
</html>