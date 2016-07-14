<?php
include('page_header.php');
require_once ('db_inc.php');  // データベース接続

if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=1 ) {
	// 学生としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	$uid  = $_SESSION['uid']; //ログイン中のユーザのuidを$uidに代入
	if (isset($_POST['cid'])){
		$cid  = $_POST['cid'] ;//送信されたcidを受け取り、$cidに代入
		$note = $_POST['note'];//送信されたnoteを受け取り、$noteに代入
		$act  = $_POST['act'] ;//送信されたactを受け取り、$actに代入
		if ($act == 'insert'){//新規登録の場合
			$sql = "INSERT INTO tb_entry VALUES('$uid','$cid',now(), '$note')";
		}else{//再登録の場合
			$sql = "UPDATE tb_entry SET cid='$cid', uid='$uid', etime=now(), note='$note' WHERE uid='$uid'";
		}
		$rs = mysql_query($sql, $conn); //SQL文を実行
		if (!$rs){
			echo "<h2>登録が失敗しました</h2>";
			echo mysql_error();
		}else{
			if ($cid==1){
				echo "<h2>情報技術応用コースに登録しました</h2>";
				echo "<h3>興味のある研究分野や自己アピール：".$note."</h3>";
			}else {
				echo "<h2>情報科学総合コースに登録しました</h2>";
				echo "<h3>興味のある研究分野や自己アピール：<br>".$note."</h3>";
			}
		}
	}else{ //エラーを表示
		echo '<h2>エラー：希望コースが選択されていません</h2>';
		echo '<p><a href="entry_input.php">戻る</a>';
	}
}
include('page_footer.php');
?>
