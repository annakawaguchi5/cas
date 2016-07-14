<?php
include('page_header.php');
if (isset($_GET['uid'])){
  $uid = $_GET['uid'];
  $sql1="SELECT * FROM tb_entry NATURAL JOIN tb_user NATURAL JOIN tb_course WHERE uid='{$uid}'";
  include ('db_inc.php');
  $rs = mysql_query($sql1, $conn);
  if (!$rs) die ('エラー: ' . mysql_error());
  $row = mysql_fetch_array($rs) ;

  $sql2="INSERT INTO tb_decide VALUE('".$row['uid']."', '".$row['uname']."', ".$row['cid'].")";
  include ('db_inc.php');
  $rs = mysql_query($sql2, $conn);
  if (!$rs) die ('エラー: ' . mysql_error());


  echo '<h2>' . $row['uname'] . 'を【'.$row['cname'].'】に決定しました。 </h2>';
  echo '<a href="user_list.php">戻る</a>';
}else{
  echo '<h2>削除するユーザIDが与えられていません</h2>';
  echo '<a href="user_list.php"><button class="btn btn-default">戻る</button></a>';
}
include('page_footer.php');
?>