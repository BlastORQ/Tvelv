<?
function _crypt($unencoded, $key){
	$string=base64_encode($unencoded);
	$arr=array();
	for($i=0;$i<strlen($string);$i++){
		$arr[$i] = sha1(sha1($key.$string[$i]).$key);
		$newstr = $newstr.substr($arr[$i], 5, 6);
	}
	$newstr=base64_encode(hex2bin($newstr));
	return $newstr;
}

function _decrypt($encoded, $key){
	$encoded = bin2hex(base64_decode($encoded));
	$strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=+/";
	for($i=0;$i<strlen($strofsym);$i++){
		$tmp = sha1(sha1($key.$strofsym[$i]).$key);
		$encoded = str_replace(substr($tmp, 5, 6), $strofsym[$i], $encoded);
	}
	return base64_decode($encoded) ;
}