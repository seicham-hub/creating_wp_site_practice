<?php

require_once('../classes/blog2.php');


$blog = new Blog();
 
$blogData = $blog->getAll();



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset = "UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ブログ一覧</title>
</head>

<body>

	<h2>ブログ一覧</h2>
	<p><a href="form2.php">新規作成</a></p>
	<table>
		<thead>
			<tr>
				<th>タイトル</th>
				<th>カテゴリ</th>
				<th>投稿日時</th>
			</tr>
		</thead>

		<?php foreach ($blogData as $colum) : ?>
		<tbody>
			<tr>
				<td><?php echo $colum['title'] ?></td>
				<td><?php echo $blog->setCategoryName($colum['category']) ?></td>
				<td><?php echo $colum['post_at'] ?></td>
				<td><a href="detail2.php?id=<?php echo $colum['id'] ?>">詳細</a></td>
				<td><a href="update_form2.php?id=<?php echo $colum['id'] ?>">編集</a></td>
			</tr>
		</tbody>
		<?php endforeach ; ?>
	</table>
	
</body>

</html>