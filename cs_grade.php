<?php
include('page_header.php');
require_once ('db_inc.php');
if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo '<h2>成績確認</h2>';
	echo '<h3 class="text-primary">'.$uname . '(' . $uid . ')</h3>';   // ログイン中のユーザ氏名とIDを表示
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}$sql = "select sum(credit*point)as取得GP,sum(credit)as登録単位数,sum(credit*point)/sum(credit)asGPA from tb_study natural join tb_subcourse natural join tb_gp where uid='$uid'" ;//検索条件を適用したSQL文を作成
$rs = mysql_query($sql);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;

$gp = $row['as取得GP'];
$credit = $row['as登録単位数'];
$gpa=$row['asGPA'];


echo '<table border=0 class="table table-hover">';
echo '<tr class="info"><th>取得GP</th><th>登録単位数</th><th>GPA</th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td>' . $gp . '</td>';
	echo '<td>' . $credit. '</td>';
	echo '<td>' . $gpa . '</td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;
}

echo '</table>';
if($gpa>=2.0000){
	echo '<h3 class="text-danger">総合コース選択可能</h3>';
}


?>