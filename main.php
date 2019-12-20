<!doctype html>
<meta charset="utf-8">
<?php
    // 接続処理
    $dsn = "mysql:****; host=localhost";
    $user = "****";
    $dbpassword = "****";
    $pdo = new PDO($dsn,$user,$dbpassword,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    // POSTで受け取ったデータ
    $insert = (!empty($_POST["insert"]));

    if($insert == true){  // 追加処理
        $newFileName = date("YmdHis")."_".$_FILES['upload_media']['name'];  // 日時 + アップロードファイル名

        move_uploaded_file($_FILES['upload_media']['tmp_name'],'./upload/'.$newFileName);   // データを保存

        $sql = $pdo -> prepare("insert into data(file_name)values(:fileName);");    // ファイルの名前を保存
        $sql -> bindParam(':fileName', $newFileName, PDO::PARAM_STR);
        $sql -> execute();
    }
?>
<html>
    <head>
        <title>MediaWare</title>
        <style>
            #content{
                text-align: center;
                padding-top: 50px;
            }

            #form{
                float: left
            }

            #user_name{
                float: right;
            }

            #destroy{
                float: right;
            }
        </style>
    </head>
    <body>
        <div id="form">
            <form action="main.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="upload_media">
                <input type="submit" value="投稿">
                <input type="hidden" name="insert" value="1">
                <input type="hidden" name="user_name" value="<?php echo $_POST["user_name"] ?>">
            </form>
        </div>

        <div id="user_name">
            <?php echo $_POST["user_name"] ?>
        </div>

        <div id="content">
            <?php
                // DB接続処理
                $dsn = "mysql:****; host=localhost";
                $user = "****";
                $password = "****";
                $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

                $sql = 'select file_name from data;';
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                
                // 結果を出力
                $i = 0;
                foreach ($results as $row){
                    if($i < 3){
                        echo '<img src="./upload/'.$row['file_name'].'" style="width: 200px;">';

                        $i++;
                    }else{
                        echo '<img src="./upload/'.$row['file_name'].'" style="width: 200px;"><br>';

                        $i = 0;
                    }
                }
            ?>
        </div>

        <div id="destroy"">
            <form action="destroy.php" method="POST">
                <input type="submit" value="はかいのボタン">
            </form>
        </div>
    </body>
</html>
