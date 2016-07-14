<?php
include('page_header.php');//画面出力開始
require_once('db_inc.php');

if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo '<h2>コース希望登録</h2>';
	echo '<h3 class="text-primary">'. $uname . '(' . $uid . ')</h3><br><h3>';   // ログイン中のユーザ氏名とIDを表示
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}
$courses = array(
1=>'情報技術応用コース',
2=>'情報科学総合コース'
);
//変数の初期化
$cid = 1;         //希望のコースID;
$act = 'insert';  //初回登録?（insert: 初回登録; update: 再登録）;

//コース決定済みでないかチェック
$sql = "select * from tb_entry where uid='$uid' not in(select uid from tb_decide)";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;

if($row==null){
	// ログイン中のユーザ($uid)の希望状況を検索する
	$sql2 = "select * from tb_entry where uid = '$uid';";
	$rs2 = mysql_query($sql2, $conn);
	if (!$rs2) die ('エラー: ' . mysql_error());
	$row2 = mysql_fetch_array($rs2) ;

	//ログイン中のユーザ($uid)のGPAを検索する
	$sql3 = "select sum(credit*point)/sum(credit)asGPA from tb_study natural join tb_subcourse natural join tb_gp where uid='$uid'";
	$rs3 = mysql_query($sql3, $conn);
	if (!$rs3) die ('エラー: ' . mysql_error());
	$row3 = mysql_fetch_array($rs3) ;
	$gpa = $row3['asGPA'];

	if ($row2) {
		$cid = $row2['cid']; // 現在登録しているコースのID
		$act = 'update';    // すでに登録したため「再登録」とする
	}
	echo '<form class="form-horizontal container" action="cs_wish_save.php" method="post">';
	echo '<input type="hidden" name="act" value="'.  $act .'">'; //非表示送信

	if($gpa>=2.0000){
		foreach ($courses as $id => $name ){
			if ($id == $cid){  //登録状況を反映したラジオボタンを作成
				echo '<input type="radio" name="cid" value="'.$id.'" checked>'.$name.'<br>';
			}else if($id != $cid){
				echo '<input type="radio" name="cid" value="'.$id.'">'.$name.'<br>';
			}
		}
	}else if($gpa<2.0000){
		echo '<input type="radio" name="cid" value="'.$id="1".'"checked>'.$name="情報技術応用コース".'<br>';
	}

	echo '<div class="form-group">';
	echo '<label for="note" class="text-danger">興味のある研究分野や自己アピール:</label>';
	echo '<textarea class="form-control" name ="note"></textarea>';
	echo '</div></h3>';

	echo '<button type="submit" class="btn btn-default col-sm-offset-1">送信</button>';
	echo '</form>';
}else{
	echo 'コースが決定しているため、この機能は利用できません。</h3>';
}

include('page_footer.php');//画面出力終了
?>
