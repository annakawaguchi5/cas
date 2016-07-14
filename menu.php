<?php
$menu0 = array(  //共通メニュー:未ログイン
 'ログイン'  => 'login.php',
);
$menu1 = array(  //学生メニュー
 '成績確認'  => 'cs_grade.php'  ,
 '希望提出'  => 'cs_wish.php' ,
 '結果確認'  => 'cs_result.php' ,
);
$menu2 = array(  //教員メニュー
 '希望一覧'  => 'cs_list.php' ,
 '未提出者'  => 'cs_noentry.php' ,
 '希望集計'  => 'cs_summary.php' ,
 'コース決定'	=> 'cs_decide.php'
);
$menu3 = array(  //管理者メニュー
 'アカウント登録'  => 'user_add.php' ,
 'アカウント一覧'  => 'user_list.php' ,
 'アカウント削除'  => 'user_delete.php' ,
 'パスワード変更'  => 'user_passwd.php'
);
$menu4 = array(  //共通メニュー:ログイン中
 'ホーム'  => 'index.php',
 'ログアウト'  => 'logout.php',
);
?>
<!-- search form
			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="検索キーワード">
				<button type="submit" class="btn btn-default">検索</button>
				</div>
			</form>
-->

<h1 id="siteTitle"><a href="index.php">コース分け希望調査システム</a></h1>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample3">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbarEexample3">

	<?php
	// ここはセッションがすでに開始したと仮定する。
	if (isset($_SESSION['urole'])){//ログイン中の場合
		$urole = $_SESSION['urole']; //ユーザ種別を調べる
		//これから$uroleの値を調べ、値に応じて異なるメニューを出力
		if($urole == 1){
			foreach($menu1 as $label=>$url){
				echo '<ul class="nav navbar-nav nav-stacked">';
				echo '<li><a href="'.$url.'">'.$label.'</a></li>';
				echo '</ul>';
			}

		}else if($urole == 2){
			foreach($menu2 as $label=>$url){
				echo '<ul class="nav navbar-nav">';
				echo '<li><a href="'.$url.'">'.$label.'</a></li>';
				echo '</ul>';

			}
		}else if($urole == 9){
			foreach($menu3 as $label=>$url){
				echo '<ul class="nav navbar-nav">';
				echo '<li><a href="'.$url.'">'.$label.'</a></li>';
				echo '</ul>';
			}
		}
			foreach($menu4 as $label=>$url){
				echo '<ul class="nav navbar-nav navbar-right">';
				echo '<li ><a href="'.$url.'">'.$label.'</a></li>';
			}

	}else{//未ログインの場合
		foreach($menu0 as $label=>$url){
				echo '<ul class="nav navbar-nav navbar-right">';
				echo '<li><a href="'.$url.'">'.$label.'</a></li>';
		}
	}
?>
								</ul>

		</div>
	</div>
</nav>
<br>

