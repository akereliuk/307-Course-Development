<?php	                                                    
$fields_1 =   array(
            "fusername" => array ("label" => "User Name", "regexp" => "/^[A-Za-z' -]{1,50}$/"),          
            "fpassword" => array ("label" => "Password", "type" => "password")
     );
$fields_2 =   array(
            "user_name"      =>  array ("label" => "User Name",	 "regexp" => "/^[A-Za-z' -]{1,50}$/i" ),    
            "password"       =>  array ("label" => "Password", "type" => "password" ),
            "email"          =>  array ("label" => "Email", "regexp" => "/^[A-Z0-9_.+-]+@[A-Z0-9-]+\.[A-Z0-9-.]+$/i" ),
            "first_name"     =>  array ("label" => "First Name", "regexp" => "/^[A-Za-z' -]{1,50}$/i"),
            "last_name"      =>  array ("label" => "Last Name",  "regexp" => "/^[A-Za-z' -]{1,50}$/i"),
            "street"         =>  array ("label" => "Street", ),
            "city"           =>  array ("label" => "City", ),
            "prov"           =>  array ("label" => "Province", ),
            "postalcode"     =>  array ("label" => "Postal Code", "regexp" => "/^[A-Z][0-9][A-Z] *[0-9][A-Z][0-9]$/i" ),
            "phone"          =>  array ("label" => "Phone" ),
           );	                                    
?>
