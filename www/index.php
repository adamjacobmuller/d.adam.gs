<?php
function rd() {
	$x=array();
	for($i=0;$i<=25;$i++) {
		$x[]=chr(rand(97,122));
	}
	return join(".",$x);
}
$rd=rd();
header(sprintf("Refresh: 0;url=http://d.adam.gs/results.php?rd=%s",$rd));
printf("<h1>please wait</h1>");
for ($i=0;$i<=25;$i++) {
	$url=sprintf("%s.%s.d.adam.gs",chr($i+97),$rd);
	printf('<img src="http://%s/pixel.gif" />%s',$url,PHP_EOL);
	$urls[]=array("url"=>$url,'seen'=>false);
}
/*
echo "\n";
flush();
$log=popen("tail -n 1000 -F /var/tinydns/log/main/current","r");
$start=microtime(true);
while ($line=trim(fgets($log))) {
	error_log(sprintf("%f - %f == %f",microtime(true),$start,microtime(true)-$start));
	if (microtime(true)-$start>20) {error_log("break");break;}
	if (preg_match("#@([0-9a-f]{16})([0-9a-f]{8}) ([0-9a-f]{24})?([0-9a-f]{8}):([0-9a-f]{4}):([0-9a-f]{4}) ([+-IC/]) ([0-9a-f]{4}) ([^ ]+)#",$line,$query)) {
		$ip=long2ip(hexdec($query[4]));
		$subject=$query[9];
		if (preg_match("#([a-z]\.".preg_quote($rd)."\.d\.adam\.gs)$#",$subject,$m)) {
			print_r($m);
		}
	} else {
		error_log("no match?");
	}
}
*/
