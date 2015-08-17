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

if ($db->connect_error) {
    $results = array();
    $results['status'] = "ERROR";
    $results['info'] = "Database error:".$db->connect_error;
	echo json_encode($results);
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
    $j = $result->fetch_array(MYSQLI_NUM);
    $k = $j[0];
    if (strlen($k) == 0) {
      $results['status'] = "ERROR";
      $results['info'] = "City name was not found";
      echo json_encode($results);
      exit(0);
    }
  } else {
     // use the code, or default
     $k = @$_REQUEST['code'];
  }
  if ($k == NULL) 
    $k = 'CYQG';

  $fileName = "http://weather.noaa.gov/pub/data/observations/" .
          "metar/stations/$k.TXT";

  $results = array();
  if ( ($fileData = @file($fileName)) == FALSE )  {
    $results['status'] = "ERROR";
  } else {
    $results['status'] = "OK";
    $m = @new METAR($fileData[1]);
    $timestamp = strtotime($fileData[0]);
    $conditions = implode(",",$m->getWeather());
    $clouds = "";
    foreach ($m->getCloudCover() as $cloud) {
	  $clouds .= implode(" ",$cloud)." ";
    }
    $relativeHumidity = round(100 * pow((112 - (0.1 * $m->getTemperature()) + $m->getDewPoint()) /
                                                (112 + (0.9 * $m->getTemperature())), 8));
    $results['code'] = $k;
    $results['obstime_GMT'] = date("Y-m-d H:i",$timestamp);
    $results['conditions'] = trim($conditions);
    $results['clouds'] = trim($clouds);
    $results['visibility'] = trim($m->getVisibility());
    $results['temp'] = $m->getTemperature();
    $results['wdir'] = $dirs[round($m->getWindDirection()/45)];
    $results['wpseed'] = trim($m->getWindSpeed());
    $results['humidity'] = $relativeHumidity;
    
    // return airport information, if available
         $query = 'SELECT * FROM airport_info where iaco = ?';
     $stmt = $db->prepare($query);
     if (!$stmt) {
	   echo $db->error;
	   exit(0);
     }
    $stmt->bind_param('s',$k);
    $stmt->execute();
    $result = $stmt->get_result();
    $j = $result->fetch_array(MYSQLI_ASSOC);
    //print_r($j);
    $results['name'] = $j['name'];
    $results['city'] = $j['city'];
    $results['country'] = $j['country'];
    $results['code3'] = $j['iata_faa'];
    $results['latitude'] = $j['latitude'];
    $results['longitude'] = $j['longitude'];
    $results['altitide'] = $j['altitude'];
    $results['timezone'] = $j['zone'];
    $results['dst'] = $j['dst'];
 
  }
  echo json_encode($results);
  exit(0);    
?>