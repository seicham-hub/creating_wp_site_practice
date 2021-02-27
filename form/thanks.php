<?php 
require_once('../config/env.php');
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>お問い合わせ内容確認/オンライン家庭教師Qリード</title>
	<meta charset="utf-8">


<!-- viewport meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-------bootstrapの読み込み-------------->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-------cssの読み込み-------------->
	 <link rel="stylesheet" type="text/css" href="form.css">

</head>

<body>


<header>
	<div class="header-logo">
		<img class="qlead-logo" src="../qleadImg/qleadlogo-cutout.png" alt="Qlead">
	</div>
</header>

<!-----------------------main----------------------->


<div class="container c-thanks pt-5">
	<h1>お問い合わせ　送信完了</h1>

	<div class="main-wrap-thanks">
		<div class="finish">お問い合わせありがとうございます。ご入力いただいたメールアドレス宛にご確認メールをお送りしております。
		メールが届いていない場合は、大変お手数ですが、迷惑メールフォルダをご確認下さい。またqlead.info@gmail.comの受信許可設定をお願いいたします。</div>

		<div class="sosin sosin-thanks">
			<input type="button" value="お問い合わせに戻る" onclick="location.href=<?php FORM_URL ?>">
		</div>

	</div>


</div>



<!---------------footer-------------------->

<footer>

	<div class="footer">

		<div class="col-6">
			<ul>
				<li><a href="mailto:qlead.info@gmail.com">qlead.info@gmail.com</a></li>
			</ul>

			<div class="sns-icon">
				<div class="snss">
					<a href="https://twitter.com/qlead2">
						<object type="image/svg+xml" data="../qleadImg/twitter.svg" width="25" height="25"></object>
					</a>
				</div>
				<div class="snss2">
					<a href="https://www.instagram.com/seicham_gram/">
						<object type="image/svg+xml" data="../qleadImg/instagram.svg" width="25" height="25"></object>
					</a>
				</div>
			</div>
		</div>

		<div class="col-6">
			<ul>
				<li><a href="">プライバシーポリシー</a></li>
				<li><a href="https://ameblo.jp/qlead/entry-12629684461.html">講師紹介</a></li>
				<li><a href="">よくある質問</a></li>
			</ul>
		</div>



	</div>

</footer>

</body>


</html>