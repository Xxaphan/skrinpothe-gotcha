<?php


class LocationsDB {
	
    public static function getLocations(){
            
           $db = PlonkWebsite::getDB();
            
           $locations = $db->retrieve('SELECT * FROM gotcha_user_location');
		
            
            return $locations;
        }
	
	
}

// EOF