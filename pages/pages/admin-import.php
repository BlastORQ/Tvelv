<?
if(!in_array(getLoginedUsername(), json_decode(ADMIN_ID))){
	header('Location: /403');
	exit();
}
$title = "Імпорт";
function pwdGen(){
	$a = array('q', 'w', 'r', 't', 'p', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n');
	$b = array('e', 'y', 'u', 'i', 'o');

	$b_count = count($b)-1;
	$a_count = count($a)-1;
	if (rand(0,1)){
		$word = 	$b[rand(0,$b_count)].$a[rand(0,$a_count)].
					$b[rand(0,$b_count)].$a[rand(0,$a_count)].
					$b[rand(0,$b_count)].$a[rand(0,$a_count)];
	}else{
		$word = 	$a[rand(0,$a_count)].$b[rand(0,$b_count)].
					$a[rand(0,$a_count)].$b[rand(0,$b_count)].
					$a[rand(0,$a_count)].$b[rand(0,$b_count)];
	}
	$word .= rand(0,9).rand(0,9);
	return $word;
}
if($_FILES['uploadfile'] AND !$_FILES['uploadfile']['error']){
	$json = file_get_contents($_FILES['uploadfile']['tmp_name']);
	$json = file_get_contents("import.json");
	$json = str_replace(["\r", "\n", "	"], "", $json);
	$arr = json_decode($json, 1);
	$printHTML = '<head><meta charset="utf-8"></head><body onload="window.print()">';
	echo '<div id="pwds">';
	foreach($arr as $a){
		if($a['Login'] AND $a['Name'] AND $a['SecondName'] AND $a['Class'] AND $a['Permission']){
			$pwd = pwdGen();
			if(registerUser($a['Login'], $pwd, $a['Permission'],  $a['Name'], $a['SecondName'], $a['Class'])){
				echo 
				"<p>".
				"<b>Ім'я: </b>".$a['Name'].' '.$a['SecondName']."<br>".
				"<b>Група: </b> Л-".$a['Class']."<br>".
				"<b>Тип: </b> ".$a['Permission']."<br>".
				"<b>Логін: </b>".$a['Login']."<br>".
				"<b>Пароль: </b>".$pwd."<br>".
				"</p>";

				$printHTML .= "<p>".
				"<b>Ім'я: </b>".$a['Name'].' '.$a['SecondName']."<br>".
				"<b>Група: </b> Л-".$a['Class']."<br>".
				"<b>Тип: </b> ".$a['Permission']."<br>".
				"<b>Логін: </b>".$a['Login']."<br>".
				"<b>Пароль: </b>".$pwd."<br>".
				"</p>";
				$notempty = 1;
			}else{
				echo  "1FAILED! ".$a['Login'].' '.$a['Name'].' '.$a['SecondName'].' '.$a['Class'].' '.$pwd."<br>";
			}
		}else{
			echo  "2FAILED! ".$a['Login'].' '.$a['Name'].' '.$a['SecondName'].' '.$a['Class'].' '.$pwd."<br>";
		}
	}
	echo "</div>";
	if($notempty){
		echo '<p><a href="data:text/html;base64,'.base64_encode($printHTML).'" target="_blank">Роздрукувати</a></p>';
		echo '<p><a href="javascript:download(\'imported.txt\', document.getElementById(\'pwds\').innerText)">Завантажити (txt)</a></p>';
	}
}else{
	?>
	<p>Тут можна імпортувати акаунти в форматі JSON.</p>
	<p>Детальніше в документації.</p>
	<form method="post" enctype="multipart/form-data">
		<p><input type="file" name="uploadfile" style="height:100px;background: #047DFC;"></p>
		<p><input type="submit"></p>
	</form>
<?;
}