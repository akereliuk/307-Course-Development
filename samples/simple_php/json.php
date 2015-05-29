<?php
// Sample script to generate some JSON output

  $data = array();
 
  $data['sunrise'] = array (
      'utctime' => date_sunrise(time(),SUNFUNCS_RET_STRING, 42.2833, 83.00, 90) ,
	  'localtime' => date_sunrise(time(),SUNFUNCS_RET_STRING, 42.2833, 83.00, 90,5) ,
	  'unixtime' => date_sunrise(time(),SUNFUNCS_RET_TIMESTAMP, 42.2833, 83.00, 90) ,  
  );
  $data['sunset'] = array (
      'utctime' => date_sunset(time(),SUNFUNCS_RET_STRING, 42.2833, 83.00, 90) ,
	  'localtime' => date_sunset(time(),SUNFUNCS_RET_STRING, 42.2833, 83.00, 90,5) ,
	  'unixtime' => date_sunset(time(),SUNFUNCS_RET_TIMESTAMP, 42.2833, 83.00, 90) ,  
  );

  echo json_encode($data);
?>
