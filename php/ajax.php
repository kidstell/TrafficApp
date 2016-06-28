<?php
set_time_limit(0);
include 'config.php';
include 'DB.php';
include 'traceFn.php';


if(isset($_REQUEST['get']) && $_REQUEST['get']=='points'){
	$startLim=($_REQUEST['zone']-1)*100;
	$sql="SELECT * FROM ".SPOTS_TBL." LIMIT {$startLim},100";
	print_r(json_encode(DB::q($sql)));
	die();
}

if(isset($_REQUEST['get']) && $_REQUEST['get']=='tracks'){
	extract($_REQUEST);
	if(!isset($point1) || !isset($point2) || ($point1==$point2)) {
		die(json_encode(array('boolErr'=>1,'errMsg'=>'choose 2 different locations')));
	}
	$tracks=journeyApp($point1,$point2,5,0,60);
	print_r(json_encode($tracks));
	die();
}

