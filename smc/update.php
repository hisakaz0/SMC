<html>
<head>
<title>SMC UPDATE PAGE</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-style-type" content="text/css">
<link rel="stylesheet" href="css/acerola.css" type="text/css">
</head>
<body>
<div id="band">
	<!-- title -->	
	<div id="vocal">
		<span class=main>SMC UPDATE PAGE</span><br>
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

function process($link, $type, $id, $barcode, $name, $value, $registed_date){

	$sql = "
		UPDATE "	 .$type." SET
		barcode =\"" 		 .$barcode."\",
		name = \""			 .$name."\",";
	if ( $type == "goods" ){
		$sql = $sql."
			value = \"" .$value."\",";
	}
	$sql = $sql."
		registed_date = \"".$registed_date."\"
		WHERE id = \"" 	 .$id."\"";

	echo $sql;

	if ( mysql_query($sql, $link) == NULL){
		echo "The query is not collect.";
	}
	else{
		// formでテーブルの型と
		echo "
			<form action=\"http://localhost/smc/check.php\" method=post name=update>
			<input type=hidden name=check_type value=".$type." />
			<input type=hidden name=id value=".$id." />
			<input type=hidden name=success value=1 />
			<button name=submit>ok</button>
			</form>
			";
		// javascriptでの自動クリック
	}
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

// 値が送られて来てるかちぇっくー
		/*
		echo
		"type = "					.$_POST['type']."<br>".
		"id = "						.$_POST['id']."<br>".
		"barcode ="				.$_POST['barcode']."<br>".
		"name = "					.$_POST['name']."<br>".
		"value = "				.$_POST['value']."<br>".
		"registed_date = ".$_POST['registed_date']."<br>";
		 */
$type =  				 $_POST['type'];
$id	=					   $_POST['id'];
$barcode = 			 $_POST['barcode'];
$name =  				 $_POST['name'];
$value =  			 $_POST['value'];
$registed_date = $_POST['registed_date'];

//main program

$flag = connect();

if ( $flag != false ){
	process($flag, $type, $id, $barcode, $name, $value, $registed_date);
}
?>

<script type="text/javascript">
document.update.submit.click();
</script>
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

