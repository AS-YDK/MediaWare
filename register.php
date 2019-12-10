<?php
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'setting.php';

    $mailaddress = $_POST["mail"];
    $password = $_POST["password"];
    $name = $_POST["name"];

    $dsn = "mysql:****; host=localhost";
    $user = "****";
    $dbpassword = "****";
    $pdo = new PDO($dsn,$user,$dbpassword,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql = $pdo -> prepare("insert into user(mail,name,password)values(:mail,:name,:password);");
    $sql -> bindParam(':mail', $mailaddress, PDO::PARAM_STR);
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':password', $password, PDO::PARAM_STR);
    $sql -> execute();

// PHPMailerのインスタンス生成
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
    $mail->SMTPAuth = true;
    $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
    $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
    $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
    $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
    $mail->Port = SMTP_PORT; // 接続するTCPポート

    // メール内容設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $mail->addAddress($mailaddress, '受信者さん'); //受信者（送信先）を追加する
//    $mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
    $mail->addCC('hogetaro.techbase@gmail.com'); // CCで追加
//    $mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
    $mail->Subject = MAIL_SUBJECT; // メールタイトル
    $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
    $body = 'ようこそ'.$name.'さん！<br><br>もしこの登録が身に覚えのない場合は以下のリンクから削除の申請をお願いします<br><br>http://****/fraudulent.html';

    $mail->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mail->send()) {
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        header("Location: ./login.html") ;
    }
?>