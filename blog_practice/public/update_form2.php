<?php
session_start();

require_once('../classes/blog2.php');




if(!isset($_SESSION['id'])){
    $id = $_GET['id'];   

}else{
    $id = $_SESSION['id'];
    $_SESSION['id'] = NULL;
}

// エラーメッセージを格納
$err = $_SESSION['err'];


// インスタンス生成
$blog = new Blog;

$result = $blog->getById($id);


// トークン生成
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
    <form action="../classes/blog_update2.php" method="POST">
        <p>ブログタイトル：</p>
        <input type="text" name="title" value="<?php echo $result['title'] ?>">
        <P><?php if(isset($err['title'])) :?>
           <?php echo Blog::h($err['title']) ?>
           <?php endif ;?>
        </P>
        <p>ブログ本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"><?php echo $result['content'] ?></textarea>
        <P><?php if(isset($err['content'])) :?>
           <?php echo Blog::h($err['content']) ?>
           <?php endif ;?>
        </P>
        <br>
        <p>カテゴリ：</p>
        <select name="category">
            <option value="1" <?php if($result['category'] === 1) echo 'selected' ?>>ブログ</option>
            <option value="2" <?php if($result['category'] === 2 ) echo 'selected' ?>>雑記</option>
        </select>
        <P><?php if(isset($err['category'])) :?>
           <?php echo Blog::h($err['category']) ?>
           <?php endif ;?>
        </P>
       
        <br>
        <input type="radio" name="publish_status" value="1" <?php if($result['publish_status'] === 1) echo 'checked' ?>>公開
        <input type="radio" name="publish_status" value="2" <?php if($result['publish_status'] === 2) echo 'checked' ?>>非公開
        <P><?php if(isset($err['publish_status'])) :?>
           <?php echo Blog::h($err['publish_status']) ?>
           <?php endif ;?>
        </P>
        <br>

        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
      
        <input type="submit" value="更新する">
    </form>

    <p><a href="../classes/blog_delete2.php?id=<?php echo $result['id'] ?>">この投稿を削除する</a></p>

    <p><a href="./">戻る</a></p>
    
</body>
</html>