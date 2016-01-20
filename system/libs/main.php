<?
ini_set('date.timezone', 'Europe/Kiev');


$dh = opendir(dirname(__FILE__).'/functions');
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
sort($files);
$arr = array();
$folders = array('button','sonts','sessions');
foreach ($files as $f) { 
	if($f AND !is_dir($f) AND !strpos(' '.$f, '!') AND !in_array($f, $folders)){
		include_once(dirname(__FILE__).'/functions/'.$f);
	} 
}