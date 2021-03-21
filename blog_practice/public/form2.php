<?php

session_start();
require_once('../classes/blog2.php');


$err = $_SESSION['err'];

var_dump($err);




$token = $_SESSION['token'] = bin2hex(random_bytes(32));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlogForm</title>
</head>
<body>
    <h2>ブログフォーム</h2>
    <form action="../classes/blog_create2.php" method="POST">
        <p>ブログタイトル：</p>
        <input type="text" name="title">

        <P><?php if(isset($err['title'])) :?>
           <?php echo Blog::h($err['title']) ?>
           <?php endif ;?>
        </P>

        <p>ブログ本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <P><?php if(isset($err['content'])) :?>
           <?php echo Blog::h($err['content']) ?>
           <?php endif ;?>
        </P>
        <br>
        <p>カテゴリ：</p>
        <select name="category">
            <option value="1">ブログ</option>
            <option value="2">雑記</option>
        </select>
        <P><?php if(isset($err['category'])) :?>
           <?php echo Blog::h($err['category']) ?>
           <?php endif ;?>
        </P>
        <br>
        <input type="radio" name="publish_status" value="1" checked>公開
        <input type="radio" name="publish_status" value="2">非公開
        <br>
        <P><?php if(isset($err['publish_status'])) :?>
           <?php echo Blog::h($err['publish_status']) ?>
           <?php endif ;?>
        </P>
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="submit" value="送信">
    </form>

    <p><a href="../">戻る</a></p>
    
</body>
</html>