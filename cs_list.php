<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo "<h2>コース希望一覧</h2>";


echo '<form action="cs_list.php" method="post">';
$course = array(1=>'応用コース',2=>'総合コース');
foreach ($course as $id=>$name){
	echo '<label class="radio-inline container-fluid">';
	echo '<input type="radio" name="cid" value="' . $id . '">' . $name;
	echo '</label>';
}
echo '<input type="submit" value="検索"><input type="reset" value="取消">';
echo '</form>';

//1. 選択されたコース種別（押されたラジオボタン）を受け取る（$_POSTから）
if(isset($_POST['cid'])){
	$cid = $_POST['cid'];
	//2. $cidを使ってSQL文のWHERE句を作成
	$where = "WHERE cid = {$cid}";
	$sql = "select * from tb_entry natural join tb_user natural join tb_course ".$where;//検索条件を適用したSQL文を作成
}else{
	$where = 'WHERE 1';
	$sql = "select * from tb_entry natural join tb_user natural join tb_course ".$where;//検索条件を適用したSQL文を作成
}// 条件なしSQLのWHERE部分を作る
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;

$sql2 = "select count(*) from tb_entry natural join tb_user natural join tb_course ".$where;
$rs2 = mysql_query($sql2, $conn);
if (!$rs2) die ('エラー: ' . mysql_error());
$row2 = mysql_fetch_array($rs2);
$total = $row2['count(*)'];

$course = array(1=>'応用コース',2=>'総合コース');

echo '<h2>計 '.$total.' 名</h2>';
echo '<table border=0 class="table table-hover">';
echo '<tr class="info"><th>ユーザID</th><th>氏名</th><th>希望コース</th></tr>';
while ($row) {
$r= $row['cid'];        // コース種別のコード（数字）を$rに代入
$cid = $course [ $r ];   // 種別の名前（配列要素）を$cidに代入
	echo '<tr>';
	echo '<td>' . $row['uid'] . '</td>';
	echo '<td>' . $row['uname']. '</td>';
	echo '<td>' . $cid . '</td>';
	echo '</tr>';

	$row = mysql_fetch_array($rs) ;
}

echo '</table>';
include('page_footer.php');  //画面出力終了
?>
