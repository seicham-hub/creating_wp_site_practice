<?php 

session_start();

require_once('../config/env.php');

//入力画面からのアクセスでなければ戻す
if(!isset($_SESSION['form'])){

	header('Location:index.php');
	exit();
}else{
	$post = $_SESSION['form'];
	$hogosha = $post["yourLastName"].$post["yourFirstName"];
	$student = $post["childrenLastName"].$post["childrenFirstName"];
	$grade	 = $post["grade"];
	$question= $post["question"];
	$mail 	 = $post["mail"];
	
}

//POSTで送信がされたら
if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$toKnows = '';

	if (isset($post["toKnow"]) && is_array($post["toKnow"])){
		foreach($post["toKnow"] as $know){
			$toKnows .= $know."・";
		}
	}
	
	// セッションを用いたので必要なくなった
	// $hogosha = $post["yourLastName"].$post["yourFirstName"];
	// $student = $post["childrenLastName"].$post["childrenFirstName"];
	// $grade	 = $post["grade"];
	// $question= $post["question"];
	// $mail 	 = $post["mail"];

	// $toKnows2 = $post["toKnows"];
	// $hogosha2 = $post["hogosha"];
	// $student2 = $post["student"];
	
}


	

    // 送信ボタンが押されたら
if (isset($_POST["submit"])) {

    // 日本語をメールで送る場合のおまじない
    mb_language("ja");
    mb_internal_encoding("UTF-8");


//////////////////////////保護者への自動返信メール/////////////////////////

    $subject = " 【お問合せいただきありがとうございます】オンライン家庭教師Qlead（キューリード）";
    



//ヒアドキュメント左詰めにしないとうまくいかないのはなぜ？
$body = <<< EOM

{$hogosha} 様

この度はお問い合わせいただきありがとうございます。
3営業日以内に担当よりご返信いたしますので、今しばらくお待ちください。

お問い合わせ内容は以下の内容で承っております。


-----------------------------------------------------------------

【お問い合わせ内容】
{$toKnows}

【受講者のお名前】
{$student}

【受講者の学年】
{$grade}

【ご質問・ご相談内容】
{$question}


EOM; 	
	
	// 送信元のメールアドレスを変数fromEmailに格納
    $fromEmail = MY_EMAIL;

    // 送信元の名前を変数fromNameに格納
    $fromName = "オンライン家庭教師Qリード";

    // ヘッダ情報を変数headerに格納する、mb_encode_mimeheaderは文字化け防ぐ    
    $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";

    // メール送信を行う
    mb_send_mail($mail, $subject, $body, $header);

    

/////////////////自分への自動返信メール//////////////////////////////

	$subject2 = "【ホームページより問い合わせがありました】";


//ヒアドキュメント左詰めにしないとうまくいかないのはなぜ？
$body2 = <<< EOM

【お問い合わせ内容】
{$toKnows}

【入力者のお名前】
{$hogosha}

【受講者のお名前】
{$student}

【受講者の学年】
{$grade}

【ご質問・ご相談内容】
{$question}

【メールアドレス】
{$mail}



EOM;


    $header = "From: " .mb_encode_mimeheader($mail);

    mb_send_mail(MY_EMAIL,$subject2,$body2,$header);

    //セッションを消してお礼画面へ
    unset($_SESSION['form']);


    // サンクスページに画面遷移させる
    header("Location:".THANKS_URL);
    

    exit();


}



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


<form action="" method="post">

	<!-- セッションを用いたので必要なくなった -->
		<!--<input type="hidden" name="toKnows" value="<?php echo $toKnows; ?>">
			<input type="hidden" name="hogosha" value="<?php echo $hogosha; ?>">
            <input type="hidden" name="student" value="<?php echo $student; ?>">
            <input type="hidden" name="grade" value="<?php echo $grade; ?>">
            <input type="hidden" name="question" value="<?php echo $question; ?>">
            <input type="hidden" name="mail" value="<?php echo $mail; ?>"> -->


	<div class="container pt-5">

		<h1>お問い合わせ内容の確認</h1>
		<div>以下のお問い合わせ内容にお間違いはないでしょうか？</div>

		<div class="m-wrap2"> 

			<div class="input-wrap">
				<div class="in-label">
					<label>お問い合わせ内容</label>
				</div>

				<div class="nyuryoku">
					<?php if(isset($post["toKnow"]) && is_array($post["toKnow"])): ?>
					<?php foreach ($post["toKnow"] as $know):?>
					<?php echo $know ?>
					<?php endforeach ?>
					<?php endif ?>
				</div>
			</div>

		


		
		
			<div class="input-wrap">
				<div class="in-label">
				<label>入力者のお名前</label>
			</div>

				<div class="nyuryoku">
					<?php echo $hogosha ?>				
				</div>

			</div>
			

			<div class="input-wrap">
				<div class="in-label">
						<label>受講者のお名前</label>
				</div>
				
				<div class="nyuryoku">
					<?php echo $student ?>
				</div>
			</div>


			<div class="input-wrap">

				<div class="in-label">
					<label>受講者の学年</label>
				</div>
				

				<div class="nyuryoku">
					<?php echo $post["grade"] ?>
				</div>
			</div>


			<div class="input-wrap">
				<div class="in-label in-l-5">
					<label>ご質問・ご相談内容</label>
				</div>

				<div class="nyuryoku nyuryoku5">
					<?php echo $post["question"] ?>
				</div>
			</div>
			

			<div class="input-wrap">
				<div class="in-label">
					<label>メールアドレス</label>
				</div>

				<div class="nyuryoku">
					<?php echo $post["mail"] ?>
				</div>
				
			</div>

		</div>


		<div class="sosin-w">
			<div class="sosin sosin-confirm">
				<input id="fix" type="button" value="内容を修正する" onclick="location.href='index.php'">
				<input type="submit" name="submit" value="送信する">
			</div>
		</div>

	</div>

</form>


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
