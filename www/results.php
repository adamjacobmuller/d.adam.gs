<?php
header("Content-type: text/plain");
$rd=$_GET['rd'];
$log=popen("tail -n 10000 /var/tinydns/log/main/current","r");
$start=microtime(true);
while ($line=trim(fgets($log))) {
	error_log(sprintf("%f - %f == %f",microtime(true),$start,microtime(true)-$start));
	if (microtime(true)-$start>20) {error_log("break");break;}
	if (preg_match("#@([0-9a-f]{16})([0-9a-f]{8}) ([0-9a-f]{24})?([0-9a-f]{8}):([0-9a-f]{4}):([0-9a-f]{4}) ([+-IC/]) ([0-9a-f]{4}) ([^ ]+)#",$line,$query)) {
		$ip=long2ip(hexdec($query[4]));
		$subject=$query[9];
		if (preg_match("#([a-z]\.".preg_quote($rd)."\.d\.adam\.gs)$#",$subject,$m)) {
			$dns[$ip]++;
		}
	} else {
		error_log("no match %s",$line);
	}
}
printf("your DNS servers:\n");
$body.="dns servers\n";
foreach($dns as $ip=>$cnt) {
	printf("\t%s\t%s\n",$ip,$cnt);
	$body.=sprintf("%s => %s\n",$ip,$cnt);
}

$body.=PHP_EOL.PHP_EOL.'$_SERVER'.PHP_EOL;
foreach($_SERVER as $k=>$v) {
	$body.=sprintf("%s => %s\n",$k,$v);
}

mail("adam@isprime.com",sprintf("d.adam.gs from %s",$_SERVER['REMOTE_ADDR']),$body,false,'-fd@adam.gs');
?>
