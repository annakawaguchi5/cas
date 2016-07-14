<?php
include('page_header.php');
require_once ('db_inc.php');  // データベース接続
if (isset($_GET['uid'])){
	$uid = $_GET['uid'];
	$sql = "SELECT uid, uname FROM tb_user WHERE uid='{$uid}'";
	include ('db_inc.php');
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs) ;
	echo '<h2>'.$row['uname'].'さんのパスワードを変更します。</h2>';
}

echo
'<br>
<div class="container-fluid bg-info">
	<form class="form-horizontal" method="post" action="user_passwd_change_do.php?uid='.$uid.'"'.'>
		<div class="form-group">
			<label for="pass" class="control-label col-sm-2" value="pass">新しいパスワード: </label>
			<div class="col-sm-10">
				<input type="password" name="pass" class="form-control" smk-type="pass">
			</div>
		</div>
		<div class="form-group">
			<label for="pass2" class="control-label col-sm-2 has-error" value="pass2">新しいパスワード(確認)： 　</label>
			<div class="col-sm-10">
				<input type="password" name="pass2" class="form-control" smk-type="pass2">
			</div>
		</div>


		<button type="submit" class="btn btn-default">
		作成
		</button>
	</form>
</div>';

echo '<script src="js/smoke.min.js"></script> <script src="js/es.min.js"></script>';

echo '<script>
$(\'button\').click(function() {
if ($(\'form\').smkValidate()) {
$.smkAlert({
text: \'パスワードが違います。\',
type: \'error\'
});
}
});
</script>';

echo '<a href="user_list.php">戻る</a>';
include('page_footer.php');
?>