<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo "<h2>コース決定一覧</h2>";

$sql = "select * from tb_entry natural join tb_user natural join tb_course where urole='1'";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;


$sql2 = "select * from tb_entry natural join tb_user natural join tb_course where uid not in(select uid from tb_decide)";//検索条件を適用したSQL文を作成
$rs2 = mysql_query($sql2, $conn);
if (!$rs2) die ('エラー: ' . mysql_error());
$row2 = mysql_fetch_array($rs2) ;

echo '<table border=0 class="table table-hover">';
echo '<tr class="info"><th>ユーザID</th><th>氏名</th><th>希望コース</th><th>興味のある研究分野や自己アピール</th><th>コース決定</th></tr>';//cssで決定ボタンを追加
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['uid'] . '</td>';
	echo '<td>' . $row['uname']. '</td>';
	echo '<td>' . $row['cname'] . '</td>';
	echo '<td>' . $row['note'] . '</td>';
	if($row['uid']==$row2['uid']){
		echo '<td><a href="cs_decide_do.php?uid='.$row['uid'] .'">
		<button class="btn btn-danger">決定</button></a>
		</td>';
		$row2 = mysql_fetch_array($rs2) ;
	}else{
		echo '<td></td>';
	}
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;

}
echo '</table>';

include('page_footer.php');  //画面出力終了
?>
