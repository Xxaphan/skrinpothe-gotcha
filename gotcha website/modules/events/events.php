<?php

/**
* Gotcha Project - Gotcha Project DB Class / Model
* 
* @author Skrin Pothé
* 
*/

require_once './library/plonk/filesystem/directory.php';



class EventsController extends PlonkController {

	

	/**
	 * The views allowed for this module
	 * @var array
	 */	
	protected $views = array(
		'events',
                'detailevent',
                'eventcreate',
                'eventcreatesucces',
                'startevent'
	);

	
	/**
	 * The actions allowed for this module
	 * @var array
	 */
	protected $actions = array(	
		'create'
	);
	


        
	/**
	 * Our default view
	 * @return 
	 */
	public function showEvents() 
	{	
                // asisgn vars in our main layout tpl
			$this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Events');
			$this->mainTpl->assign('pageMeta', 		'');
			$this->mainTpl->assign('pageH2', 		'Events');
                        
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)){
		// Main Layout
                        
			$this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');  
                }else{
                     $this->mainTpl->assignOption('oNotLogged');
                }
                
                $events = EventsDB::getEvents();	       
                $this->pageTpl->setIteration('iEvents');
                
                
                $teller = 0;
                
                
                foreach($events as $event){
                    $this->pageTpl->assignIteration('iEventId', $event['id']);
                    
                    if($teller&1) {
                            $this->pageTpl->assignIteration('iColor', 	'oneven');
                    }else{
                            $this->pageTpl->assignIteration('iColor', 	'even');
                    }
                    $teller++;
                    $this->pageTpl->assignIteration('iName', $event['eventname']);
                    
                    if($event['status'] == 1){
                        $this->pageTpl->assignIteration('iStatus', 'PROGRESS');
                        $this->pageTpl->assignIteration('iStatusColor', 'progress');
                    }else if($event['status'] == 2){
                        $this->pageTpl->assignIteration('iStatus', 'FINISHED');
                        $this->pageTpl->assignIteration('iStatusColor', 'finished');
                    }else{
                         $this->pageTpl->assignIteration('iStatus', 'NOT STARTED YET');
                         $this->pageTpl->assignIteration('iStatusColor', 'setup');
                    }
                    
                    $usernames = EventsDB::getUsername($event['organizer']);                   
                    
                        $this->pageTpl->assignIteration('iOrganizer', $usernames['username']);
                        $this->pageTpl->assignIteration('iOrganizerId', $usernames['id']);
                    
                        
                    if($event['start'] == '0000-00-00'){
                        $this->pageTpl->assignIteration('iStart', '');
                    }else {
                        $this->pageTpl->assignIteration('iStart', $event['start']);
                    }    
                    
                    
                    if($event['end'] == '0000-00-00'){
                        $this->pageTpl->assignIteration('iEnd', '');
                    }else {
                        $this->pageTpl->assignIteration('iEnd', $event['end']);
                    }
                    
                    
                    $this->pageTpl->refillIteration();						
		}					
					
                // parse iteration
                $this->pageTpl->parseIteration();
                	
		
		// Page Specific Layout
                        
	}
        
        public function showDetailevent() 
	{	
                // asisgn vars in our main layout tpl
			$this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Events');
			$this->mainTpl->assign('pageMeta', 		'');
			$this->mainTpl->assign('pageH2', 		'Events');
                        
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)){
		// Main Layout
                        
			$this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');  
                }else{
                     $this->mainTpl->assignOption('oNotLogged');
                }
                
                $event = EventsDB::getEvent(PlonkFilter::getGetValue('eventid'));
                $organizer = EventsDB::getOrganizer($event['organizer']);
              
                
                $this->pageTpl->assign('eventname', $event['eventname']);
                $this->pageTpl->assign('organizer', $organizer['username']);
                
                if($event['status'] == 1){
                    $this->pageTpl->assign('status', 'PROGRESS');
                    $this->pageTpl->assign('statusColor', 'progress');
                }else if($event['status'] == 2){
                    $this->pageTpl->assign('status', 'FINISHED');
                    $this->pageTpl->assign('statusColor', 'finished');
                }else{
                     $this->pageTpl->assign('status', 'NOT STARTED YET');
                     $this->pageTpl->assign('statusColor', 'setup');
                }
                
                if($event['start'] == '0000-00-00'){
                    $this->pageTpl->assign('start', '');
                }else {
                    $this->pageTpl->assign('start', $event['start']);
                }    


                if($event['end'] == '0000-00-00'){
                    $this->pageTpl->assign('end', '');
                }else {
                    $this->pageTpl->assign('end', $event['end']);
                }
                
                $users = EventsDB::getPartUsers(PlonkFilter::getGetValue('eventid'));	       
                $this->pageTpl->setIteration('iUsers');
               
                
                $even = "even";
                $oneven = "oneven";	
                $teller = 0;
                
                foreach($users as $user){
                    if($teller&1) {
                            $this->pageTpl->assignIteration('iColor', 	$oneven);
                    }else{
                            $this->pageTpl->assignIteration('iColor', 	$even);
                    }
                    $teller++;
                    $this->pageTpl->assignIteration('iUsername', $user['username']);
                    $this->pageTpl->assignIteration('iUserId', $user['id']);
                    
                    $played = EventsDB::getTimesPlayed(($user['id']));
                   $won = EventsDB::getTimesWon($user['id']);
                 
                    
                    $this->pageTpl->assignIteration('iPlayed', $played['played']);
                    $this->pageTpl->assignIteration('iWon', $won['won']);
                    $this->pageTpl->refillIteration();						
		}					
					
                // parse iteration
                $this->pageTpl->parseIteration();
               
                	
		
		// Page Specific Layout
                        
	}
        
        	/**
	 * Our default view
	 * @return 
	 */
	public function showEventCreate() 
	{	
            // asisgn vars in our main layout tpl
            $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Create Event');
            $this->mainTpl->assign('pageMeta', 		'');
            $this->mainTpl->assign('pageH2', 		'Create Event');
            
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
                    // Main Layout
                        $this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');
				
					
			$this->pageTpl->assign('formUrl', $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=events&' . PlonkWebsite::$viewKey . '=eventcreate');
                        
                        $this->pageTpl->assign('organizer', PlonkFilter::getGetValue('id'));
                         
		
		// Page Specific Layout
                }else{
                    PlonkWebsite::redirect('index.php?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=login');
                    $this->mainTpl->assignOption('oNotLogged');
                }
		

                        
	}
        
        
        public function doCreate() {
            $eventName = (string) PlonkFilter::getPostValue('eventname', null, '');           
            $organizer = (int)PlonkFilter::getPostValue("organizer");
            
            $participants = "";
            $number_part = 1;
            $members = $organizer;
            
            for($i = 0; $i<= 10; $i++){
                if(PlonkFilter::getPostValue("parti0".$i) != "") {
                    if($i == 10){
                        $number_part++;
                        $participants = $participants. PlonkFilter::getPostValue("parti".$i) .",";
                        $member = EventsDB::getMemberId(PlonkFilter::getPostValue("parti".$i));
                        $members = $members.','.$member['id'];
                        
                    }else{
                        $number_part++;
                        $participants = $participants. PlonkFilter::getPostValue("parti0".$i) .",";
                        $member = EventsDB::getMemberId(PlonkFilter::getPostValue("parti0".$i));
                        $members = $members.','.$member['id'];
                        
                    }
                    
                }
                
            }           
            
            $eventId =  EventsDB::insertEvent($eventName, $organizer, $number_part);
            $organizerInfo = EventsDB::getUsername($organizer);

            $membersArray = explode(",", $members); 
            
            EventsDB::createTempEventTable($eventId["id"], $membersArray);
            
            mail($participants, "Inventation for Gotcha Mobile Event", "U have been invited by ".$organizerInfo['username']." for his gotcha mobile event: ". $eventName ."<br /> 
                to join this event you should register to accept the event. If you already have an account you can login and accept the event on your profile page.", "FROM: ".$organizerInfo['email']);
            $url = $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=events&' . PlonkWebsite::$viewKey .'=eventcreatesucces';
            PlonkWebsite::redirect($url);

	} 
        
        public function showEventcreatesucces() 
	{	
            // asisgn vars in our main layout tpl
            $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Create Event');
            $this->mainTpl->assign('pageMeta', 		'');
            $this->mainTpl->assign('pageH2', 		'Create Event');
            
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
                    // Main Layout
                        $this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');
				
					
			
                         
		
		// Page Specific Layout
                }else{
                    PlonkWebsite::redirect('index.php?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=login');
                    $this->mainTpl->assignOption('oNotLogged');
                }
		

                        
	}
        
        public function showStartevent() 
	{	
            // asisgn vars in our main layout tpl
            $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Start Event');
            $this->mainTpl->assign('pageMeta', 		'');
            $this->mainTpl->assign('pageH2', 		'Start Event');
            
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
                    // Main Layout
                        $this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');                        
				
			if(EventsDB::checkState(PlonkFilter::getGetValue('eventid'))){
                            $this->pageTpl->assignOption('oHasStarted');
                            
                            EventsDB::startEvent(PlonkFilter::getGetValue('eventid'));
                            
                            
                        }else {
                            $this->pageTpl->assignOption('oHasNotStarted');
                            
                            
                            $acceptedDeclined = EventsDB::getAcceptDeclineInfo(PlonkFilter::getGetValue('eventid'));
                            
                             $this->pageTpl->setIteration('iAcceptDecline');
                             $teller = 0;
                              $even = "even";
                                $oneven = "oneven";
                             foreach($acceptedDeclined as $acceDecl){
                                 $this->pageTpl->assignIteration('iParticipant', 	$acceDecl["username"]);
                                 $this->pageTpl->assignIteration('iState', 	$acceDecl["state"]);
                                 if($teller&1) {
                                        $this->pageTpl->assignIteration('iColor', 	$oneven);
                                }else{
                                        $this->pageTpl->assignIteration('iColor', 	$even);
                                }
                                $teller++;
                                $this->pageTpl->refillIteration();						
                             }					
					
                            // parse iteration
                            $this->pageTpl->parseIteration();
                            
                            
                        
                        }		
			
                         
		
		// Page Specific Layout
                }else{
                    PlonkWebsite::redirect('index.php?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=login');
                    $this->mainTpl->assignOption('oNotLogged');
                }
		

                        
	}
	
		
}

// EOF