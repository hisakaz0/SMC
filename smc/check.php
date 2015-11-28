<html>
<head>
<title>SMC CHECK PAGE</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<link rel="stylesheet" href="css/acerola.css" type="text/css">
<body>

<div id="band">


	<!-- title -->	
	<div id="vocal">
		<span class=main>SMC CHECK PAGE</span><br>
		The page show 
<?php
echo $type;
?>
		.<br>
		変更したい登録データがあれば，その登録データの左側にあるチェックボタンをクリックし，印をつけた状態で，okを押して下さい．
	</div>
	<div id="melody">
		<br>
		&ensp; <span class=sub>REFERENCE</span><br>


<?php

// homeだとsmc databaseがないから
// dieで処理が終了するためそれ以降が読み取られない
// なので、学校ではこれをコメントを外す
// 
//--home ver.----------------------------------
//			/*  
//				--中身(刺身)--
//			*/
//			
//--labo ver.-----------------------------------
//		//	/*
//				--中身(ハラミ)--

function process($link, $type, $id, $act) {

	// typeを数字で示す
	// 0 ... goods / 1 ... user
	$what = 0;
	if ( $type == "user" ){
		$what = 1;
	}
	if ( $act != 2 ){
		echo "<br>----------";
		switch ($what) {
		case 0:
			echo "商品";
			break;
		case 1:
			echo "ユーザ";
			break;
		}
		echo "を";
		switch ($act){
		case 0:
			echo "登録";
			break;
		case 1:
			echo "変更";
			break;
		}
		echo "しました．----------<br>";
	}


	$value_title_line = "<th class=value>VALUE</th>";
	//変数を型ごと格納できないからやめました
	//$value_res_line		= "<th class=value>".$item[$a]."</th>";
	$start_th = "<th>";
	$end_th = "</th>";
	// 初期値はgoodsのラベルの数
	$label_num = 5;
	if ( $type == "user" ){
		$value_title_line = NULL;
		$value_res_line 	= NULL;
		$label_num = 4;
	}

	// form start
	echo "<form action=\"http://localhost/smc/input.php\" method=\"post\">";

	//mysqlにqueryをなげる
	$sql = "SELECT * FROM ".$type;
	$res = mysql_query($sql, $link);
	echo "<br>
		<table>
		<tr>
		<th>recode</th>
		<th>=</th>
		<th>".mysql_num_rows($res)."
		</tr>
		</table>
		";
	echo "<table border=0 bgcolor=\"#000000\" cellspacing=0 cellpadding=0>
		<tr>
		<td>
		<table border=0 cellspacing=1 cellpadding=3>
		<tr class=red>
		<th><br></th>
		<th class=id>ID</th>
		<th class=barcode>BARCODE</th>
		<th class=goods>NAME</th>
		".$value_title_line."
		<th class=datetime>DATETIME</th>
		</tr>
		";
	while ($item = mysql_fetch_array($res)) {
	
		if ( $item[0] == $id ){
			echo "<tr class=blue>";
		}
		else{
			echo "<tr class=red>";
		}		
			echo $start_th."<input type=radio name=id value=".$item[0].">".$end_th;

			for($a=0; $a < $label_num; $a++){
				echo $start_th.$item[$a].$end_th;
			
		
		}
		echo "</tr>";
	}
	echo "			</table
		</td>
		</tr>
		</table>";

	// form end

	echo "<div id=button>
		<input type =\"hidden\" name=\"type\" value=\"".$type."\"/>
		<button>update</button> &ensp;
	</form>

		<input type=\"button\" value=\"back\" onClick=\"location.href='http://localhost/smc/smc.php'\">
		</div>";
}

function connect() {

	//parameter
	$url    = "localhost";
	$user   = "root";
	$passwd = "07s49power";
	$db 	= "smc";

	$link = mysql_connect($url, $user, $passwd) or die("failed");
	mysql_select_db($db, $link) or die("Not found such a database");
	$sql = "SET CHARACTER SET UTF8";
	mysql_query($sql, $link) or die("Can't set character-set to UTF8");
	return $link;
}

$type = $_POST['check_type'];
$id   = $_POST['id'];
$act  = $_POST['success'];
//main program

$flag = connect();

if ( $flag != false ){
	process($flag, $type, $id, $act);
}

?>


		</div>

		<div id="keyboard">
			<br>
			<span class=sub>Note</span>
		</div>

		<div id="drum" align=right>
			<br><br>
			現在ページ作成中 ver.1.2 &emsp;<br>
		</div>

	</div>




	</body>
	</html>

