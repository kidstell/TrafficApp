<?php
set_time_limit(0);
include_once 'config.php';
include_once 'DB.php';

function getSpot($spotid){
	$sql="SELECT * FROM `".SPOTS_TBL."` WHERE sn ={$spotid}";
	$spot=DB::q($sql);
	return $spot[0];
}

function getLinks($spotid){
	$sql="SELECT * FROM `".LINKS_TBL."` a, `".SPOTS_TBL."` b WHERE a.stop_point_sn = b.sn AND a.start_point_sn ={$spotid}";
	$links=DB::q($sql);
	return $links;
}

function trackInit($start_point,$target,$shortestdistance){

	$tracks=getLinks($start_point['sn']);

	foreach ($tracks as $key => $value) {
		$tracks[$key]['places']=array();
		$tracks[$key]['places'][]=$start_point['point_name'];
		$tracks[$key]['places'][]=$tracks[$key]['point_name'];

		$distaway=geoGetDistance($tracks[$key]['lat'],$tracks[$key]['lng'],$target['lat'],$target['lng'],'K');

		$tracks[$key]['times']=array(0, ($tracks[$key]['distance_km']/$tracks[$key]['ave_speed_today']));
		$tracks[$key]['distaway']=array($shortestdistance,$distaway);
		$tracks[$key]['travelled']=array(0,$tracks[$key]['distance_km']);
		$tracks[$key]['probate']=0;
	}
	return $tracks;
}
	// $maxGeoDistAway=0;

function journeyApp($start_sn,$stop_sn,$minNoTracks=0,$diversionLimit=0,$maxRounds=0){
	
	$minNoTracks=($minNoTracks<1)?5:$minNoTracks;
	$diversionLimit=($diversionLimit<1)?10:$diversionLimit;
	$maxRounds=($maxRounds<1)?30:$maxRounds;

	$start_point=getSpot($start_sn);
	$target=getSpot($stop_sn);

	$found=array();
	$tracksfound=$rounds=$leastprobed=$mostprobed=$mosttravelled=$leasttravelled=0;
	$farthest=$nearest=$shortestdistance=geoGetDistance($start_point['lat'],$start_point['lng'],$target['lat'],$target['lng'],'K');

	$tracks=trackInit($start_point,$target,$shortestdistance);

	while ($tracksfound<$minNoTracks) {
		$mvmnt=$tracks; $passlist=array();

		foreach ($mvmnt as $mk => $mv) {
			if (count($tracks)>=21 && count($tracks)%3) {
				if ($mv['probate']==count($mv['distaway'])) continue;
			}
			$linkables=getLinks($mv['stop_point_sn']);
			foreach ($linkables as $lk => $lv) {
				if (in_array($lv['point_name'], $mv['places'])) continue;//avoiding reverse movement
				
				$da=geoGetDistance($lv['lat'],$lv['lng'],$target['lat'],$target['lng'],'K');

				$lv['places']=$mv['places'];					$lv['places'][]=$lv['point_name'];
				$lv['times']=$mv['times'];						$lv['times'][]=$mv['distance_km']/$mv['ave_speed_today'];
				$lv['distaway']=$mv['distaway'];			$lv['distaway'][]=$da;
				$lv['travelled']=$mv['travelled'];		$lv['travelled'][]=$lv['distance_km'];
				$lv['probate']=$mv['probate'];

				if ($rounds>=15 && $rounds%3) {
					if ($lv['probate']>=$mostprobed-1) {
						$mostprobed=0;
						$leastprobed=0;
						continue;
					}
				}
				if ($da>$mv['distaway'][count($mv['distaway'])-1]) {
					$lv['probate']=$mv['probate']+1;
					if ($lv['probate']>=$diversionLimit) continue;//removing paths going astray
					$mostprobed=max($mostprobed,$lv['probate']);
					$leastprobed=($leastprobed>0)?min($leastprobed,$lv['probate']):$lv['probate'];
				}
				if ($lv['stop_point_sn']==$stop_sn) {
					$lv['total_time']=(array_sum($lv['times'])*60);
					$lv['total_dist']=array_sum($lv['travelled']);
					$found[]=$lv;
					$tracksfound++;
					continue;
				}else{
					$passlist[]=$lv;
				}
			}
		}
		if (count($passlist)==0||$rounds>$maxRounds) {
			if ($tracksfound>0) {break;}
			$t['tracks']=$tracks;
			$t['tracksfound']=count($tracks);
			$t['reachable']=0;
			return $t;
		}
		$tracks=$passlist;
		$rounds++;
	}
	$full['tracks']=$found;
	$full['reachable']=1;
	$full['tracksfound']=$tracksfound;
	return $full;
}





//print_r(journeyApp(1,2,5,10));
