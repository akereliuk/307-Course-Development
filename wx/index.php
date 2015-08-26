<?php

// index.php
// Given a valid weather station (as a variable to this script), JSON formatted results will be
// returned.
//
// In case of error, the key status will be set to ERROR.
// On success, the key status will be set to OK with additional data fields.
//

include("Message.php");
use METAR\Message as METAR;
DEFINE ('DB_USER', 'steve_student');
DEFINE ('DB_PASSWORD', '60307dB');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'steve_60307');
$dirs = array('N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW', 'N');
header("application/json");

mysqli_report(MYSQLI_REPORT_STRICT); 

$db = @new MySQLi(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$airports = array();

if ($db->connect_error) {
	exit(0);
}

  if (isset($_REQUEST['city'])) {
     // if city is set, look it up by name
     $query = 'SELECT iaco FROM airport_info where city like ?';
     $stmt = $db->prepare($query);
     if (!$stmt) {
	   echo $db->error;
	   exit(0);
     }
    $stmt->bind_param('s',$_REQUEST['city']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($j = $result->fetch_array(MYSQLI_ASSOC)) {
		$airports[] = $j['iaco'];
    }
  }
  if (isset($_REQUEST['code'])) {
	  $airports[] = $_REQUEST['code'];
  }
 
  $index = 0;
  $results = array();
  foreach ($airports as $airport) {
    $fileName = "http://weather.noaa.gov/pub/data/observations/" .
          "metar/stations/$airport.TXT";

    if ( ($fileData = @file($fileName)) == TRUE )  {
      $results[$index]['status'] = "OK";
	  
    $m = @new METAR($fileData[1]);
    $timestamp = strtotime($fileData[0]);
    $conditions = implode(",",$m->getWeather());
    $clouds = "";
    foreach ($m->getCloudCover() as $cloud) {
	  $clouds .= implode(" ",$cloud)." ";
    }
    $relativeHumidity = round(100 * pow((112 - (0.1 * $m->getTemperature()) + $m->getDewPoint()) /
                                                (112 + (0.9 * $m->getTemperature())), 8));
    $results[$index]['code'] = $airport;
    $results[$index]['obstime_GMT'] = date("Y-m-d H:i",$timestamp);
    $results[$index]['conditions'] = trim($conditions);
    $results[$index]['clouds'] = trim($clouds);
    $results[$index]['visibility'] = trim($m->getVisibility());
    $results[$index]['temp'] = $m->getTemperature();
    $results[$index]['wdir'] = $dirs[round($m->getWindDirection()/45)];
    $results[$index]['wpseed'] = trim($m->getWindSpeed());
    $results[$index]['humidity'] = $relativeHumidity;
    
    // return airport information, if available
         $query = 'SELECT * FROM airport_info where iaco = ?';
     $stmt = $db->prepare($query);
     if (!$stmt) {
	   echo $db->error;
	   exit(0);
     }
    $stmt->bind_param('s',$airport);
    $stmt->execute();
    $result = $stmt->get_result();
    $j = $result->fetch_array(MYSQLI_ASSOC);
    //print_r($j);
    $results[$index]['name'] = $j['name'];
    $results[$index]['city'] = $j['city'];
    $results[$index]['country'] = $j['country'];
    $results[$index]['code3'] = $j['iata_faa'];
    $results[$index]['latitude'] = $j['latitude'];
    $results[$index]['longitude'] = $j['longitude'];
    $results[$index]['altitide'] = $j['altitude'];
    $results[$index]['timezone'] = $j['zone'];
    $results[$index]['dst'] = $j['dst'];
    $index++;
  }
  }
  $json['datapoints'] = $results;
  echo json_encode($json);
  exit(0);    
?>
