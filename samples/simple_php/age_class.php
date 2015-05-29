<?php 

// Examples from Lecture on March 11, 2015

class A {
    public $foo = 1;
}  

// DateTime Samples

$a = new DateTime();
echo "<p>{$a->format('l F jS')}</p>";
$a->modify("+4 weeks");
echo "<p>{$a->format('l F jS')}</p>";
$a->setDate(2016,1,1);
echo "<p>{$a->format('l F jS')}</p>";

$start = new DateTime("Jan 8, 2015");
$end = new DateTime("April 10, 2015");

$semester = $start->diff($end);
echo "The semester is ".$semester->format("%a")." days long.<br />";

$dtz = new DateTimeZone("America/Detroit");
print_r($dtz->getLocation());


echo "<hr />";

// For the allowed format controls in the format() method for DateInterval
// Visit: http://php.net/manual/en/dateinterval.format.php

// A class called person that is given a full name and a birthdate (as a string)
// A rounded age to the decade and the first name are available as public properties

class person {
	public $age;
	public $name;
	private $fullname;
	private $birthdate;
    public function __construct($name, $datestring) {
	    $this->birthdate = new DateTime($datestring);
		$this->age = $this->calc_age()."0's";
		$names = explode(" ",$name);
		$this->name = $names[0];
		$this->fullname = $name;
    }
    private function calc_age() {
		$now_time = new DateTime();
		$interval = $now_time->diff($this->birthdate);
		$diff = $interval->y;
		unset($interval);
		return floor($diff/10);
	}	
	public function strlen_name() {
		return strlen($this->fullname);
	}
}

$mary = new person("Mary Jones","1986-12-04");
//echo $mary->birthdate;
//Fatal error: Cannot access private property person::$birthdate 
//echo $mary->calc_age();
//Fatal error: Call to private method person::calc_age() from 

echo "{$mary->name}: {$mary->age}<br />";
echo $mary->strlen_name()."<br />";

$steve = new person("Steve Smith","1966-08-24");
echo "{$steve->name}: {$steve->age}<br />";

echo "<p>".str_pad($mary->name,$mary->strlen_name(),"*").":".$mary->age."</p>";

?>