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
					<span class=main>SMC UPDATE PAGE</span><br>
					The page show 
<?php
echo $type;
?>
.<br>
選択したい項目があれば新しく内容を書き換えてください．
</div>
<div id="melody">
	<br>
	&ensp; <span class=sub>UPDATE</span><br>


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

function process($link, $type) {
/*
echo
echo $_POST["success"];
//regist.phpからデータ登録が成功した場合
if ( $_POST['success'] == null){
echo "<br>
----- データが登録されました -----
<br>";
}
 */

	$value_title_line = "<th class=value>VALUE</th>";
	$value_res_line		= "<th class=value>".$item[$a]."</th>";
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
	echo "<form action=\"http://localhost/smc/update.php\" method=\"post\">";

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
		echo "<tr class=red>"
			.$start_th."<input type=radio name=id value=".$item[0].">".$end_th;
		
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
		<button>update</button> &ensp;
	</form>
		<button onClick=\"history.go(-1)\">back</button>
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

//main program

$flag = connect();

if ( $flag != false ){
	process($flag, $type);
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

