<?php 
session_start();

/*$error = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	//フォームの送信時にエラーをチェックする

	$post = filter_input_array(INPUT_POST,$_POST);//FILTER_SANITIE_STRING);

	if($post['name'] === ''){
		$error['name'] = 'blank';
	}

}
*/



$nyuryokuErr=$nameErr1=$nameErr2=$mailErr="";
$mailErr2=$gradeErr="";

$Errors = [];


if ($_SERVER["REQUEST_METHOD"] === "POST" ){
	//フォームの送信時にエラーをチェックする

	// フォームの値を配列に入れる。特殊文字を除去する。
	$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

	/*function test_input($data){
		$data = trim($data);//余分なスペース、タブ、改行を取り除く
		$data = stripslashes($data);//バックスラッシュを削除
		$data = htmlspecialchars($data,ENT_QUOTES, 'UTF-8');
		return $data;
	}*/


	$hogosha = $post['yourLastName'].$post['yourFirstName'];
	$student =$post['childrenLastName'].$post['childrenFirstName'];
	$grade	 = $post['grade'];
	$question= $post['question'];
	$mail 	 = $post['mail'];


	if(empty($post['toKnow'])){
		$nyuryokuErr = "項目を選択してください";
		$Errors['nyuryoku'] = 'blank';
	}
	if(empty($post['yourLastName']) || empty($post["yourFirstName"])){
		$nameErr1 = "名前を入力してください";
		$Errors['name1'] = 'blank';
	}
	if(empty($post['childrenLastName']) || empty($post['childrenFirstName'])){
		$nameErr2 = "名前を入力してください";
		$Errors['name2'] = 'blank';
	}
	if(empty($post['grade'])){
		$gradeErr="学年を選択してください";
		$Errors['grade'] = 'blank';
	}

	if(empty($post['mail'])){
		$mailErr = "メールアドレスを入力してください";
		$Errors['email'] = 'blank';
	}else if(!filter_var($post['mail'],FILTER_VALIDATE_EMAIL)){
		$mailErr2 = "メールアドレスを正しくご記入ください";
		$Errors['email'] = 'email';
	}





	if(count($Errors) === 0 ){
		//エラーがないので確認画面に移動
		$_SESSION['form'] = $post;
		header('Location: confirm.php');
		exit();
	}

//リロードしたとき（get送信時）に値が消えないように
}else{
	if(isset($_SESSION['form'])){
		$post = $_SESSION['form'];
		$grade	 = $post['grade'];
		$question= $post['question'];
		$mail 	 = $post['mail'];
		}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>体験授業・資料請求/オンライン家庭教師Qリード</title>
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

<div class="container pt-5">


	<h1>お問い合わせフォーム</h1>
	<div>無料体験授業および資料請求は下記よりお申し込みください。</div>

	<nav>
		<ul class="breadcrumbs">
			<li><a href="https://www.qlead.info/" >TOP</a></li>
			<li>お問い合わせフォーム</li>
		</ul>
	</nav>
	

	<div class="m-wrap">

<!-- 	<,>,&などの特殊文字をhtmlエンティティに変換-->		
	
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES , 'UTF-8');?>" method="post" >
			
			<div class="input-wrap">
				<div class="in-label">
					<label>お問い合わせ内容</label>
				</div>


				<div class="nyuryoku nyuryoku1">
					<input id="siryou" type="checkbox" name="toKnow[]" value="資料請求" 
					<?php if( isset($post['toKnow']) && in_array('資料請求',$post['toKnow']) ) echo "checked" ; ?>
					><label for="siryou">資料請求</label>

					<input id="taiken" type="checkbox" name="toKnow[]" value="無料体験授業"
					<?php if(isset($post['toKnow']) && in_array('無料体験授業',$post['toKnow']) ) echo "checked" ; ?>
						><label for="taiken">無料体験授業</label>

					<input id="soudan" type="checkbox" name="toKnow[]" value="学習相談"
					<?php if(isset($post['toKnow']) && in_array('学習相談',$post['toKnow']) ) echo "checked" ?>
					><label for="soudan">学習相談・面談</label>


					<input id="sonota" type="checkbox" name="toKnow[]" value="その他"><label for="sonota"
					<?php if(isset($post['toKnow']) && in_array('その他',$post['toKnow']) ) echo "checked" ?>
					>その他のお問い合わせ</label>

					<div class="ErrMessage"><?php echo $nyuryokuErr?></div>	
				</div>
			</div>

	
			

		


		
		
			<div class="input-wrap">
				<div class="in-label">
					<label>入力者のお名前</label>
				</div>
				

				<div class="nyuryoku nyuryoku-name">
					姓<input type="text" name="yourLastName" placeholder="九州" value="<?php echo htmlspecialchars($post['yourLastName']); ?>">
					名<input type="text" name="yourFirstName" placeholder="花子" value="<?php echo htmlspecialchars($post['yourFirstName']); ?>">
					<div class="ErrMessage"><?php echo $nameErr1?></div>			
				</div>
		
				

			</div>
			

			<div class="input-wrap">
				<div class="in-label">
						<label>受講者のお名前</label>
				</div>

				
				<div class="nyuryoku nyuryoku-name">
					姓<input type="text" name="childrenLastName" placeholder="九州" value="<?php echo htmlspecialchars($post['childrenLastName']); ?>"> 
					名<input type="text" name="childrenFirstName" placeholder="太郎" value="<?php echo htmlspecialchars($post['childrenFirstName']); ?>">
					<div class="ErrMessage"><?php echo $nameErr2?></div>
				</div>

				
			</div>


			<div class="input-wrap">

				<div class="in-label">
					<label>受講者の学年</label>
				</div>
				

				<div class="nyuryoku">
					<select name="grade" size="1">
						<option disabled selected value="">選択してください</option>
						<option value="小学1年生" <?php if($grade=="小学1年生") echo "selected" ;?>>小学1年生</option>
						<option value="小学2年生" <?php if($grade=="小学2年生") echo "selected" ;?>>小学2年生</option>
						<option value="小学3年生" <?php if($grade=="小学3年生") echo "selected" ;?>>小学3年生</option>
						<option value="小学4年生" <?php if($grade=="小学4年生") echo "selected" ;?>>小学4年生</option>
						<option value="小学5年生" <?php if($grade=="小学5年生") echo "selected" ;?>>小学5年生</option>
						<option value="小学6年生" <?php if($grade=="小学6年生") echo "selected" ;?>>小学6年生</option>
						<option value="中学1年生" <?php if($grade=="中学1年生") echo "selected" ;?>>中学1年生</option>
						<option value="中学2年生" <?php if($grade=="中学2年生") echo "selected" ;?>>中学2年生</option>
						<option value="中学3年生" <?php if($grade=="中学3年生") echo "selected" ;?>>中学3年生</option>
						<option value="高校1年生" <?php if($grade=="高校1年生") echo "selected" ;?>>高校1年生</option>
						<option value="高校2年生" <?php if($grade=="高校2年生") echo "selected" ;?>>高校2年生</option>
						<option value="高校3年生" <?php if($grade=="高校3年生") echo "selected" ;?>>高校3年生</option>
						<option value="その他" <?php if($grade=="その他") echo "selected" ?>>その他</option>
					</select>
					<div class="ErrMessage"><?php echo $gradeErr?></div>
				</div>

				

			</div>


			<div class="input-wrap">
				<div class="in-label in-l-5">
					<label>ご質問・ご相談内容</label>
				</div>

				<div class="nyuryoku nyuryoku5">
					<textarea name="question" placeholder="学習面でのご不安やお悩みがあれば教えてください。その他気になる点もお気軽にご質問ください。"
					><?php echo $question; ?></textarea>
				</div>
			</div>
			

			<div class="input-wrap">
				<div class="in-label">
					<label>メールアドレス</label>
				</div>

				<div class="nyuryoku nyuryoku-last">
					<input type="email" name="mail" placeholder="example@.com" value="<?php echo htmlspecialchars($mail) ?>">
				<div class="ErrMessage"><?php echo $mailErr?></div>
				<div class="ErrMessage"><?php echo $mailErr2?></div>
				</div>

				
				
			</div>

		</div>

		<div class="sosin">
			<input type="submit" value="確認画面へすすむ">
		</div>
	</form>


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









	 <!-- jQuery、Popper.js、Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>