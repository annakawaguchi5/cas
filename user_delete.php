<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo '<h2>ユーザ削除画面</h2>';
echo '削除するユーザを選択してください。';
?>
<br>
<?php
echo '<form method="post">';
$users = array(1=>'学生',2=>'教員',9=>'管理者');
foreach ($users as $id=>$name){
	echo '<label class="radio-inline container-fluid">';
	echo '<input type="radio" name="urole" value="' . $id . '">' . $name;
	echo '</label>';
}
echo '<input type="submit" value="検索"><input type="reset" value="取消">';
echo '</form>';

//1. 選択されたユーザ種別（押されたラジオボタン）を受け取る（$_POSTから）
if(isset($_POST['urole'])){
	$urole = $_POST['urole'];
	//2. $uroleを使ってSQL文のWHERE句を作成
	$where = "WHERE urole = {$urole}";
}else{
	$where = 'WHERE 1';
} // 条件なしSQLのWHERE部分を作る
	$sql = "SELECT * FROM tb_user " . $where;//検索条件を適用したSQL文を作成
	$rs = mysql_query($sql, $conn);
	if (!$rs) die ('エラー: ' . mysql_error());

	$row = mysql_fetch_array($rs) ;
	echo '<table border=0 class="table table-hover">';
	echo '<tr class="info"><th>ユーザID</th><th>氏名</th><th>種別</th><th>操作</th></tr>';
	while ($row) {
		echo '<tr>';
		echo '<td>' . $row['uid'] . '</td>';
		echo '<td>' . $row['uname']. '</td>';
		// echo '<td>' . $row['urole'] . '</td>';
		$roles = array( 1=>'学生', 2=>'教員', 9=>'管理者');
		$r= $row['urole'];        // 種別のコード（数字）を$rに代入
		$urole = $roles [ $r ];   // 種別の名前（配列要素）を$uroleに代入
		echo '<td>' . $urole . '</td>';
		echo '<td><a href="user_delete_check.php?uid='.$row['uid'].'"'.'>
		<button class="btn btn-danger">削除</button></a></td>';
		echo '</tr>';
		$row = mysql_fetch_array($rs) ;
	}
	echo '</table>';

	include('page_footer.php');  //画面出力終了
?>
