<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
echo "<h2>希望集計</h2>";
/*
$where = ' WHERE 1';
$sql = "select * from tb_entry natural join tb_user natural join  tb_course order by cid;";//検索条件を適用したSQL文を作成
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;


$sql2 = "select count(*) from tb_entry natural join tb_user natural join  tb_course group by cid order by cid;";//検索条件を適用したSQL文を作成
$rs2 = mysql_query($sql2, $conn);
if (!$rs2) die ('エラー: ' . mysql_error());
$row2 = mysql_fetch_array($rs2);
$total = $row2['count(*)'];
*/
$sql = "SELECT cname, COUNT( * ) AS 人数
FROM tb_entry
NATURAL JOIN tb_course
GROUP BY tb_course.cid
UNION
SELECT cname, 0
FROM tb_course
WHERE cid NOT
IN (

SELECT cid
FROM tb_entry
)";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;

//$course = array(1=>'応用コース',2=>'総合コース');


echo '<table border=0 class="table table-hover">';
echo '<tr class="info"><th>コース</th><th>人数</th></tr>';
while ($row) {
 echo '<tr>';
 echo '<td>' . $row['cname'] . '</td>';
 echo '<td>' . $row['人数']. '</td>';
 echo '</tr>';
 $row = mysql_fetch_array($rs) ;
}
echo '</table>';

include('page_footer.php');  //画面出力終了
?>
