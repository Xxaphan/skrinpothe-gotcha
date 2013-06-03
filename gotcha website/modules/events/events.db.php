<?php


class EventsDB {
    
    public static function getEvents()
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$events = $db->retrieve('SELECT * FROM gotcha_events');
		
		// return the result
		return $events;
		
	}
        
        public static function getEvent($eventid)
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$event = $db->retrieveOne(sprintf(
                        'SELECT * FROM gotcha_events 
                            WHERE gotcha_events.id = "%s"',
			$db->escape($eventid)));
		
		// return the result
		return $event;
		
	}
        
        public static function getOrganizer($orgenizerId)
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$username = $db->retrieveOne(sprintf(
                        'SELECT * FROM gotcha_users WHERE id = "%s"',
			$db->escape($orgenizerId)));
		
		// return the result
		return $username;
		
	}
        
        
        public static function getUsername($userid)
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$username = $db->retrieveOne(sprintf(
                        'SELECT * FROM gotcha_users WHERE id = "%s"',
			$db->escape($userid)));
		
		// return the result
		return $username;
		
	}
        
        
           public static function getPartUsers($eventid)
	{
		
		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		$username = $db->retrieve(sprintf(
                        'SELECT gotcha_users.username, gotcha_users.id FROM gotcha_event_participants
                            INNER JOIN gotcha_users on gotcha_event_participants.userid = gotcha_users.id WHERE eventid = "%s"',
			$db->escape($eventid)));
		
		// return the result
		return $username;
		
	}
        
        public static function getTimesPlayed($userid){
            
            $db = PlonkWebsite::getDB();
            
           $played = $db->retrieveOne(sprintf(
                        'SELECT count(eventid) as played FROM gotcha_event_participants WHERE userid = "%s"',			
			$db->escape($userid)
		));
		
            
            return $played;
        }
        
        public static function getTimesWon($userid){
            
            $db = PlonkWebsite::getDB();
            
           $won = $db->retrieveOne(sprintf(
                        'SELECT count(eventname) as won FROM gotcha_events WHERE winner = "%s"',			
			$db->escape($userid)
		));
		
            
            return $won;
        }
        
        public static function insertEvent($eventname, $organizer, $number_part){
            
            $db = PlonkWebsite::getDB();
            
            $sql = 'INSERT INTO gotcha_events (eventname, organizer, invited_participants, accepted_participants, status) 
                VALUES("'.$eventname.'",'.$organizer.','.$number_part.',1,0)';
            
            $db->execute($sql);
                        
            
            $eventid = $db->retrieveOne(sprintf(
                        'SELECT id FROM gotcha_events WHERE eventname = "%s" AND organizer = "%d"',
			$db->escape($eventname),
                        $db->escape($organizer)
                    ));
		
		// return the result
		return $eventid;
            
        }
        
        public static function getMemberId($email){
            $db = PlonkWebsite::getDB();
            
            $id = $db->retrieveOne(sprintf(
                        'SELECT id FROM gotcha_users WHERE email = "%s" ',
			$db->escape($email)
                    ));
            
            return $id;
        }
        
        public static function createTempEventTable($eventid, $membersArray){
            $db = PlonkWebsite::getDB();
            
            $sql = "CREATE TABLE IF NOT EXISTS `gotcha_event_".$eventid."` (
                    `id` INT NOT NULL AUTO_INCREMENT ,
                    `members` VARCHAR( 50 ) NULL ,
                    `state` VARCHAR( 50 ) NULL ,
                    PRIMARY KEY ( `id` )
            ) ENGINE = MYISAM ;";
            $db->execute($sql);
            
            for($i = 0; $i < sizeof($membersArray); $i++) {
                if($i == 0){
                    $sql2 = 'INSERT INTO gotcha_event_'.$eventid.' (members, state) 
                             VALUES("'.$membersArray[$i].'","accepted")';
                    $db->execute($sql2);
                }else {
                    $sql2 = 'INSERT INTO gotcha_event_'.$eventid.' (members, state) 
                             VALUES("'.$membersArray[$i].'","not accepted")';
                    $db->execute($sql2);
                }    
            } 
        }
        
        public static function getAcceptDeclineInfo($eventid){
            $db = PlonkWebsite::getDB();
            
           $acceptDecline = $db->retrieve('Select gotcha_event_'.$eventid.'.state as state, gotcha_users.username as username from gotcha_event_'.$eventid.'
               INNER JOIN gotcha_users on gotcha_event_'.$eventid.'.members = gotcha_users.id');
           
           return $acceptDecline;
            
            
            
            
        }
        
        public static function checkState($eventid){
            $db = PlonkWebsite::getDB();
            
            $sql = 'SELECT state from gotcha_event_'.$eventid.' WHERE state="not accepted"';
            
            $states = $db->execute($sql);
            
            if($states){
                return false;
            }else {
                return true;
            }
        }
        public static function startEvent($eventid){
            $db = PlonkWebsite::getDB();
            
            $accptedParti = $db->retrieve('select members from gotcha_event_'.$eventid.' WHERE state="accepted"');
           
            
            foreach($accptedParti as $parti){
                
                do {
                    
                    $rand = rand(1,sizeof($accptedParti));
                 
                    
                }while ($rand == $parti["members"]);
                
                $sql = 'INSERT INTO gotcha_event_participants (userid, eventid, target) 
                             VALUES('.$parti["members"].','.$eventid.','.$rand.')';
                
                $db->execute($sql);
                
                
                $updateSql = 'UPDATE gotcha_events SET status = 1 WHERE id = ' .$eventid . ' ';
                 $db->execute($updateSql);
                    
                   
		$table = 'gotcha_event_'.$eventid;
                echo $table;
		$db->execute('DROP TABLE '.$table);
                
            }
        }
        
	
}

// EOF