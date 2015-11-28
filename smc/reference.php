<html lang=ja>
<head>
	<title>SMC REFERENCE PAGE</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="content-style-type" content="text/css">
	<link rel="stylesheet" href="css/acerola.css" type="text/css">
<body>
	
	<div id="band">


		<!-- title -->	
		<div id="vocal">
			<br>
			&ensp;
			<span class=main>
				SMC REFERENCE PAGE
			</span><br>
			&ensp;
			The page is for reference.<br>
			&ensp;
			You can check your payment recode.

			</div>	
	
		<div id="melody">
		<br>
		 <span class=sub>REFERENCE</span><br>
		

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
	//		//	*/

function process($link, $category, $data, $column) {
	
	//mysqlにqueryをなげる
	$sum = 0;
	$sql = "SELECT * FROM payment WHERE ".$column." = \"".$data."\"";
	$res = mysql_query($sql, $link);

	//合計金額だぜ
	while ( $itme =mysql_fetch_array($res) ){
		$sum += $itme[2];
	}

	echo "<br>
				<table>
					<tr>
						<th>|</th>
						<th>".$category."</th>
						<th>=</th>
						<th>".$data."</th>
						<th>|</th>
						<th>RECODE</th>
						<th>=</th>
						<th>".mysql_num_rows($res)."</th>
						<th>|</th>
						<th>SUM</th>
						<th>=</th>
						<th>".$sum."</th>
						<th>|</th>
					</tr>
				</table>
				<br>
				";
	echo "<table border=0 bgcolor=\"#000000\" cellspacing=0 cellpadding=0>
					<tr>
					  <td>
						  <table border=0 cellspacing=1 cellpadding=3>
								<tr class=red>
									<th class=id>ID</th>
									<th class=goods>GOODS</th>
									<th>VALUES</th>
									<th class=user>NAME</th>
									<th class=datetime>DATETIME</th>
								</tr>
								";
	$res = mysql_query($sql, $link);
	while ($item = mysql_fetch_array($res)) {	
		echo "			<tr class=red>
									<th class=id>				".$item[0]."</th>
									<th class=goods>		".$item[1]."</th>
									<th> 								".$item[2]."</th>
									<th class=user>			".$item[3]."</th>
									<th class=datetime>	".$item[4]."</th>
								</tr>
				";
	}
	echo "			</table
						</td>
					</tr>
				</table>
				";
}

function check($link, $data, $type){
	
	//-----データ変換プロセス-----
	//payment_date  そのまま
	//barcode				名前に変換
	//name					そのまま
	//goods					そのまま


	//-----payment_date-----
	if ( $type == "payment_date" ){
		$column = $type;
		$category = "PAYMENT DATE";
	}
	//-----barcode & name-----
	//入力データのチェックも行うので
	//同時に変換も行なってしまおう
	else{
		$sql = "SELECT name FROM goods WHERE ".$type." = \"".$data."\"";
		$res = mysql_query($sql, $link);
		$column = "goods";
		$category = "GOODS";
		//goodsの方になければuserの方で検索
		if ( mysql_fetch_array($res) == null ) {
			$sql = "SELECT name FROM user WHERE ".$type." = \"".$data."\"";
			$column = "user";
			$category = "USER";
		}
		$res = mysql_query($sql, $link);
		//resからnameの取得
		while ($item = mysql_fetch_array($res)) {
				$data = $item[0];
		}
	}
	if ( $data == null ){
		echo "入力データは該当しません.<br>";
	}
	return array($category, $data, $column);
}
 
function connect() {

	//parameter
	$url    = "localhost";
	$user   = "root";
	$passwd = "07s49power";
	$db 	  = "smc";

	//preparation
	$link = mysql_connect($url, $user, $passwd) or die("failed");
	mysql_select_db($db, $link) or die("Not found such a database");
	$sql = "SET CHARACTER SET UTF8";
	mysql_query($sql, $link) or die("Can't set character-set to UTF8");
	return $link;
}
 
//入力確認
$data = $_POST["reference_data"];
$type = $_POST["reference_type"];
	
$flag; //入力に不備があるか判定
	
if ( $data == null ){
	$flag = -1; 
	echo "<br>";
	echo "入力に不備があります.<br>";
	echo "データを入力してください.<br>";
}

//main program
//入力されたか?
if ( $flag != -1 ) {
	$link = connect();
	//接続できたか?
	if ( $link != false ){
		list($category, $data, $column) =	check($link, $data, $type);
		//入力データは正しいか?
		if ( $data != null ){
			process($link, $category, $data, $column);
		}
	}
}

?>

		</div>

		<div id="back">
			<form>
				<input type="button" value="back" onClick="location.href='http://localhost/smc/smc.php">
			</form>
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

