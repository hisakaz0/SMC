<?php

// c言語のscanfをphpで実現しよう
function scanf() 
{ 
   $stdin = fopen("php://stdin", "r"); 
   $line = trim(fgets($stdin, 64)); 
   fclose($stdin); 
   return $line; 
}

{
	$handle = fopen("res-sheet.cvs","a");
	fwrite($handle,"回数,変数連結,socket_connect,socket_write,socket_read,socket_close,sleep1,echo,if,led点灯,sleep3,led消灯\n");
	fclose($handle);
}

$i = 0;
while(10 - $i++){
	// parameter setting{
	$a = 1;
	$port = 12345;
	$addr = '192.168.7.83';
	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	
	$handle = fopen("res-sheet.cvs","a");
	fwrite($handle,$i);
	fwrite($handle,",");

// 値読み取り{
	$user = scanf();
	$goods = scanf();
	
	${'time'.$a++} = microtime(true);
	$buf = $user."/".$goods;
	

// 接続関係

	${'time'.$a++} = microtime(true);
	$azakazu = ${'time'.$a};
	socket_connect($sock, $addr, $port);

	
	${'time'.$a++} = microtime(true);
	$hisakazu = ${'time'.$a};

	$omekazu = $hisakazu - $azakazu;
	echo $omekazu;

	socket_write($sock,$buf,1024);

	${'time'.$a++} = microtime(true);
	$res = socket_read($sock,1024);
	
	${'time'.$a++} = microtime(true);
	socket_close($sock);
	
	${'time'.$a++} = microtime(true);
	sleep(1);
	
	${'time'.$a++} = microtime(true);
	echo $res."\n";

	${'time'.$a++} = microtime(true);
	if($res == 0 ){
		
		${'time'.$a++} = microtime(true);
		system('gpio -g write 18 1');

		${'time'.$a++} = microtime(true);
		sleep(3);
		
		${'time'.$a++} = microtime(true);
		system('gpio -g write 18 0');
	}
	else{
		${'time'.$a++} = microtime(true);
		system('gpio -g write 4 1');
	
		${'time'.$a++} = microtime(true);
		sleep(3);
		
		${'time'.$a++} = microtime(true);
		system('gpio -g write 4 0');
	}

	
	${'time'.$a++} = microtime(true);

	$limit = $a;
	for($a = 2; $a < $limit; $a++){
		$b = $a - 1;
		$time = ${'time'.$a} - ${'time'.$b};
		fwrite($handle, sprintf('%0.16f', $time));
		fwrite($handle, ",");
	}
	fwrite($handle,"\n");

	fclose($handle);


}

?>



	



