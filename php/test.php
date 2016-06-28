<?php
set_time_limit(0);

/*
$l=0.000009*19*1000;

$lat1=6.465422;
$lat2=$lat1+$l;

$lon1=3.406448;
$lon2=$lon1+$l;
echo $d=geoGetDistance($lat1,$lon1,$lat2,$lon2,$unit='K');
*/

function geoGetDistance($lat1,$lon1,$lat2,$lon2,$unit='M') {
    
  // calculate miles
  $M =  69.09 * rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2)))); 

  switch(strtoupper($unit))
  {
    case 'K':
      // kilometers
      return $M * 1.609344;
      break;
    case 'N':
      // nautical miles
      return $M * 0.868976242;
      break;
    case 'F':
      // feet
      return $M * 5280;
      break;            
    case 'I':
      // inches
      return $M * 63360;
      break;            
    case 'M':
    default:
      // miles
      return $M;
      break;
  }
}
  echo $dlon=geoGetDistance(6.465422,3.406448,6.465422,3.5029325000008,$unit='K');
  die();

$lat1=$lat2=6.465422;

$lon1=$lon2=3.406448;

$area=$tries=0;
while ($area<344) {
  $tries++;
  if (lcg_value()>0.75) {
    $lon2+=0.3*0.000009;
  }else{
    $lat2+=0.3*0.000009;
  }
  $dlat=geoGetDistance($lat1,$lon1,$lat2,$lon1,$unit='K');
  $dlon=geoGetDistance(6.465422,3.406448,6.7556530999546,3.5029325000008,$unit='K');
  $area=$dlon*$dlat;
}
echo 'Area: '.$area."<br>\n";//344.00169046384,344.0002208749
echo 'Tries: '.$tries."<br>\n";//135337,135146
echo 'lat1: '.$lat1."<br>\n";//6.465422
echo 'lon1: '.$lon1."<br>\n<br>\n";//3.406448

echo 'lat2: '.$lat2."<br>\n";//6.72146299996, 6.7205611999601
echo 'lon2: '.$lon2."<br>\n";//3.5158169000009,3.5162030000009

//$lat1-$lat2=0.25604099996


/*
Area: 344.00021698482
Tries: 143228
lat1: 6.465422
lon1: 3.406448

lat2: 6.7556530999546
lon2: 3.5029325000008

lat distance=32.270673224598
lng distance=10.659840115223

lat difference=0.2902310999546
lon difference=0.0964845000008
*/
/*
echo "starting Point<br>\n Lat:";
echo $lat1=6.465422;//6.465422;
echo " ...Lng:";
echo $lon1=3.406448;//3.406448;
$meshsize=0.000001;
echo "<br>\n";

$d=0;
while ($d<1) {
  $meshsize+=0.0000001;
  echo $lat2=$lat1+$meshsize; echo "...";
  $lon2=$lon1;//+($meshsize*$i);
  echo "...";
  echo $d=geoGetDistance($lat1,$lon1,$lat2,$lon2,$unit='K')*1000;
  echo "meters using:".$meshsize;echo "<br>\n";
}

echo $meshsize;
die();
$meshsize=0.000009;*/
?>
<html>
<head></head>
<body>
starting Point<br>
Lat:6.465422 ...Lng:3.406448<br>
6.4654231......0.094930730546311meters using:1.1E-6<br>
6.4654232......0.094930730546311meters using:1.2E-6<br>
6.4654233......0.094930730546311meters using:1.3E-6<br>
6.4654234......0.13425232662458meters using:1.4E-6<br>
6.4654235......0.16442484850584meters using:1.5E-6<br>
6.4654236......0.13425232662458meters using:1.6E-6<br>
6.4654237......0.16442484850584meters using:1.7E-6<br>
6.4654238......0.18986146109262meters using:1.8E-6<br>
6.4654239......0.21227156665527meters using:1.9E-6<br>
6.465424......0.2325318507481meters using:2.0E-6<br>
6.4654241......0.21227156665527meters using:2.1E-6<br>
6.4654242......0.2325318507481meters using:2.2E-6<br>
6.4654243......0.25116310480322meters using:2.3E-6<br>
6.4654244......0.26850465324916meters using:2.4E-6<br>
6.4654245......0.26850465324916meters using:2.5E-6<br>
6.4654246......0.28479219163893meters using:2.6E-6<br>
6.4654247......0.30019732847006meters using:2.7E-6<br>
6.4654248......0.30019732847006meters using:2.8E-6<br>
6.4654249......0.31484961429645meters using:2.9E-6<br>
6.465425......0.31484961429645meters using:3.0E-6<br>
6.4654251......0.34227761660198meters using:3.1E-6<br>
6.4654252......0.35519826918045meters using:3.2E-6<br>
6.4654253......0.35519826918045meters using:3.3E-6<br>
6.4654254......0.36766513844917meters using:3.4E-6<br>
6.4654255......0.37972292218525meters using:3.5E-6<br>
6.4654256......0.40275697987374meters using:3.6E-6<br>
6.4654257......0.40275697987374meters using:3.7E-6<br>
6.4654258......0.41379346108786meters using:3.8E-6<br>
6.4654259......0.43502725850593meters using:3.9E-6<br>
6.465426......0.43502725850593meters using:4.0E-6<br>
6.4654261......0.45527179008511meters using:4.1E-6<br>
6.4654262......0.46506370149621meters using:4.2E-6<br>
6.4654263......0.47465365273156meters using:4.3E-6<br>
6.4654264......0.49327454551753meters using:4.4E-6<br>
6.4654265......0.50232620960645meters using:4.5E-6<br>
6.4654266......0.50232620960645meters using:4.6E-6<br>
6.4654267......0.51121762925356meters using:4.7E-6<br>
6.4654268......0.52855193847317meters using:4.8E-6<br>
6.4654269......0.54533552870491meters using:4.9E-6<br>
6.465427......0.54533552870491meters using:5.0E-6<br>
6.4654271......0.56161777577991meters using:5.1E-6<br>
6.4654272......0.56958438327787meters using:5.2E-6<br>
6.4654273......0.58519232469176meters using:5.3E-6<br>
6.4654274......0.60039465694013meters using:5.4E-6<br>
6.4654275......0.60785326163829meters using:5.5E-6<br>
6.4654276......0.62250242962452meters using:5.6E-6<br>
6.4654277......0.62969922859289meters using:5.7E-6<br>
6.4654278......0.64385154010423meters using:5.8E-6<br>
6.4654279......0.65081229958925meters using:5.9E-6<br>
6.465428......0.66451511382418meters using:6.0E-6<br>
6.4654281......0.67794101786577meters using:6.1E-6<br>
6.4654282......0.68455523320396meters using:6.2E-6<br>
6.4654283......0.69759555224431meters using:6.3E-6<br>
6.4654284......0.70402514025644meters using:6.4E-6<br>
6.4654285......0.72297090461461meters using:6.5E-6<br>
6.4654286......0.73533027689834meters using:6.6E-6<br>
6.4654287......0.74143270748291meters using:6.7E-6<br>
6.4654288......0.75348931440967meters using:6.8E-6<br>
6.4654289......0.76535601789864meters using:6.9E-6<br>
6.465429......0.77704151841313meters using:7.0E-6<br>
6.4654291......0.78855387168024meters using:7.1E-6<br>
6.4654292......0.79424747537776meters using:7.2E-6<br>
6.4654293......0.81108851733341meters using:7.3E-6<br>
6.4654294......0.82212424252921meters using:7.4E-6<br>
6.4654295......0.833013779813meters using:7.5E-6<br>
6.4654296......0.84376278927342meters using:7.6E-6<br>
6.4654297......0.8543765749168meters using:7.7E-6<br>
6.4654298......0.86486011526182meters using:7.8E-6<br>
6.4654299......0.87521809063501meters using:7.9E-6<br>
6.46543......0.89052918929194meters using:8.0E-6<br>
6.4654301......0.89557472082625meters using:8.1E-6<br>
6.4654302......0.91054358017021meters using:8.2E-6<br>
6.4654303......0.92038758063834meters using:8.3E-6<br>
6.4654304......0.93495926617124meters using:8.4E-6<br>
6.4654305......0.94930730546312meters using:8.5E-6<br>
6.4654306......0.95404203461257meters using:8.6E-6<br>
6.4654307......0.96810729499052meters using:8.7E-6<br>
6.4654308......0.97737169071852meters using:8.8E-6<br>
6.4654309......0.99110592401829meters using:8.9E-6<br>
6.465431......0.99564190160228meters using:9.0E-6<br>
6.4654311......1.0091275078167meters using:9.1E-6<br>
<br>
<br>
<br>
<br>
9.1E-6
</body>
</html>