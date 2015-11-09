<?
include "../../libs/main.php";
?>
<style>div{margin-top:16px;margin-bottom:16px;height:35%;}body{margin:16px;font-family: 'Lato Thin', Arial;}</style>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1', {
packages: ['corechart', 'bar']
});

google.setOnLoadCallback(drawStats);

function drawStats(){
	<?php
	if(is_teacher()){
		$marks = mark_get_by_params(
			['Teacher[=]' => get_logined()]
		);
	}else{
		$marks = mark_get_by_params(
			['Student[=]' => get_logined()]
		);
	}
	$arr = [0,0,0,0,0,0,0,0,0,0,0,0,0];
	foreach($marks as $a){
		$arr[$a['Mark']]++;
	}
	?>
	drawBasic('stats1', [
	        ['1', <?=$arr[1];?>],
	        ['2', <?=$arr[2];?>],
	        ['3', <?=$arr[3];?>],
	        ['4', <?=$arr[4];?>],
	        ['5', <?=$arr[5];?>],
	        ['6', <?=$arr[6];?>],
	        ['7', <?=$arr[7];?>],
	        ['8', <?=$arr[8];?>],
	        ['9', <?=$arr[9];?>],
	        ['10', <?=$arr[10];?>],
	        ['11', <?=$arr[11];?>],
	        ['12', <?=$arr[12];?>]
	    ], 'Статистика оцінок');

	<?php
	$marks = mark_get_by_params(
		['Class[=]' => 31]
	);
	$arr = [0,0,0,0,0,0,0,0,0,0,0,0,0];
	foreach($marks as $a){
		$arr[$a['Mark']]++;
	}
	?>
	drawBasic('stats2', [
	        ['1', <?=$arr[1];?>],
	        ['2', <?=$arr[2];?>],
	        ['3', <?=$arr[3];?>],
	        ['4', <?=$arr[4];?>],
	        ['5', <?=$arr[5];?>],
	        ['6', <?=$arr[6];?>],
	        ['7', <?=$arr[7];?>],
	        ['8', <?=$arr[8];?>],
	        ['9', <?=$arr[9];?>],
	        ['10', <?=$arr[10];?>],
	        ['11', <?=$arr[11];?>],
	        ['12', <?=$arr[12];?>]
	    ], 'Статистика всіх оцінок групи');

	<?php
	$marks = mark_get_all();
	$arr = [0,0,0,0,0,0,0,0,0,0,0,0,0];
	foreach($marks as $a){
		$arr[$a['Mark']]++;
	}
	?>
	drawBasic('stats3', [
	        ['1', <?=$arr[1];?>],
	        ['2', <?=$arr[2];?>],
	        ['3', <?=$arr[3];?>],
	        ['4', <?=$arr[4];?>],
	        ['5', <?=$arr[5];?>],
	        ['6', <?=$arr[6];?>],
	        ['7', <?=$arr[7];?>],
	        ['8', <?=$arr[8];?>],
	        ['9', <?=$arr[9];?>],
	        ['10', <?=$arr[10];?>],
	        ['11', <?=$arr[11];?>],
	        ['12', <?=$arr[12];?>]
	    ], 'Статистика всіх оцінок');
}
function drawBasic(id, arr, titl) {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Оцінка');
    data.addColumn('number', 'Кількість');

    data.addRows(arr);

    var options = {
        title: titl,
        hAxis: {
            title: 'Оцінка',
            viewWindow: {min: [1, 30, 0],max: [13, 30, 0]}
        },
        vAxis: {title: 'Кількість'}
    };
    var chart = new google.visualization.ColumnChart(
    document.getElementById(id));
    chart.draw(data, options);
}
    </script>
<div id="stats1"></div>
<div id="stats2"></div>
<div id="stats3"></div>
<div id="stats4"></div>