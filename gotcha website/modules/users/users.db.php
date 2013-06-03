<?php


class UsersDB {
    
    public static function getUsers()
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$users = $db->retrieve('SELECT * FROM gotcha_users');
		
		// return the result
		return $users;
		
	}
        
        public static function getUser($userid)
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$user = $db->retrieveOne(sprintf(
                        'SELECT username FROM gotcha_users 
                            WHERE gotcha_users.id = "%s"',
			$db->escape($userid)));
		
		// return the result
		return $user;
		
	}
        
        public static function getUserInfo($username){
            // get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$userInfo = $db->retrieveOne(sprintf(
                        'SELECT * FROM gotcha_users 
                            WHERE gotcha_users.username = "%s"',
			$db->escape($username)));
		
		// return the result
		return $userInfo;
        }
        
        public static function getUserInfoWithId($userid){
            // get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$userInfo = $db->retrieveOne(sprintf(
                        'SELECT * FROM gotcha_users 
                            WHERE gotcha_users.id = "%s"',
			$db->escape($userid)));
		
		// return the result
		return $userInfo;
        }
        
        public static function getOrgEvents($userid){
            $db = PlonkWebsite::getDb();
            
            $orgevents = $db->retrieve(sprintf(
                        'SELECT * FROM gotcha_events 
                            WHERE gotcha_events.organizer = "%s"',
			$db->escape($userid)));
		
		// return the result
		return $orgevents;
        }
        
         public static function getPartEvents($userid){
            $db = PlonkWebsite::getDb();
            
            $partevents = $db->retrieve(sprintf(
                        'SELECT * FROM gotcha_event_participants 
                            WHERE userid = "%s"',
			$db->escape($userid)));
		
		// return the result
		return $partevents;
        }
        
        public static function getPartEvents2($eventid){
            $db = PlonkWebsite::getDb();
            
            $partevents = $db->retrieve(sprintf(
                        'SELECT * FROM gotcha_events 
                            WHERE id = "%s"',
			$db->escape($eventid)));
		
		// return the result
		return $partevents;
        }
	
	
}

// EOF