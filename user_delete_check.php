<?php
include('page_header.php');
if (isset($_GET['uid'])){
  $uid = $_GET['uid'];
  echo '<h2>'. $uid . 'を本当に削除しますか?</h2>';
  echo '<a href="user_delete_do.php?uid='. $uid . '"><button class="btn btn-danger">削除</button></a>';
  echo '<a href="user_list.php"><button class="btn btn-default">戻る</button></a>';
}else{
  echo '<h2>削除するユーザIDが与えられていません</h2>';
  echo '<a href="user_list.php">戻る</a>';
}
include('page_footer.php');
?>