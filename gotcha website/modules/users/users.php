<?php

/**
* Gotcha Project - Gotcha Project DB Class / Model
* 
* @author Skrin Pothé
* 
*/

require_once './library/plonk/filesystem/directory.php';



class UsersController extends PlonkController {

	/**
	 * The views allowed for this module
	 * @var array
	 */	
	protected $views = array(
                'myprofile',
                'profile',
                'list',		
	);

	
	/**
	 * The actions allowed for this module
	 * @var array
	 */
	protected $actions = array(	
		'create'
	);


	      

        
        public function showMyProfile() 
	{	
            // Main Layout
                        
                // asisgn vars in our main layout tpl
                $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Profile');
                $this->mainTpl->assign('pageMeta', 		'');
                $this->mainTpl->assign('pageH2', 		'Profile');
                
                
                
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
                    	
                        
			$this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');
                        
                        $this->pageTpl->assign('username', PlonkSession::get('name'));
                        
                        $user = UsersDB::getUserInfo(PlonkSession::get('name'));
                        
                        $this->pageTpl->assign('userid', $user['id']);
                        
                        $this->pageTpl->assign('url', $user['profilepic']);
                        $this->pageTpl->assign('firstname', $user['firstname']);
                        $this->pageTpl->assign('lastname', $user['name']);
                        $this->pageTpl->assign('email', $user['email']);
                        $this->pageTpl->assign('cellph', $user['cellphone']);
                        
                        
                        $teller = 0;
                        $orgEvents = UsersDB::getOrgEvents($user['id']);
                        $this->pageTpl->setIteration('iOrgEvents');
                        
                        foreach($orgEvents as $orgEvent){
                            $this->pageTpl->assignIteration('iEventId', $orgEvent['id']);
                    
                            if($teller&1) {
                                    $this->pageTpl->assignIteration('iColor', 	'oneven');
                            }else{
                                    $this->pageTpl->assignIteration('iColor', 	'even');
                            }
                            $teller++;
                            $this->pageTpl->assignIteration('iName', $orgEvent['eventname']);

                            if($orgEvent['status'] == 1){
                                $this->pageTpl->assignIteration('iStatus', 'PROGRESS');
                                $this->pageTpl->assignIteration('iStatusColor', 'progress');
                                $this->pageTpl->assignIterationOption('oEdi');                                        
                            }else if($orgEvent['status'] == 2){
                                $this->pageTpl->assignIteration('iStatus', 'FINISHED');
                                $this->pageTpl->assignIteration('iStatusColor', 'finished');
                            }else{
                                 $this->pageTpl->assignIteration('iStatus', 'NOT STARTED YET');
                                 $this->pageTpl->assignIteration('iStatusColor', 'setup');
                                 $this->pageTpl->assignIterationOption('oGo');
                                 $this->pageTpl->assignIterationOption('oEdi');
                                 $this->pageTpl->assignIterationOption('oDel');
                                 
                            }
                            
                            $this->pageTpl->assignIteration('iParMem', $orgEvent['accepted_participants']);
                            
                            $this->pageTpl->refillIteration();						
                        }					
					
                // parse iteration
                $this->pageTpl->parseIteration();
                
                
                $teller2 = 0;
                        $partEvents = UsersDB::getPartEvents($user['id']);
                       
                        
                        
                        $this->pageTpl->setIteration('iPartEvents');
                        
                        foreach($partEvents as $partEvent){
                            
                            $partEventss = UsersDB::getPartEvents2($partEvent['eventid']);
                            
                            
                            foreach($partEventss as $partEvents2){
                                $this->pageTpl->assignIteration('iEventId2', $partEvents2['id']);
                    
                            if($teller2&1) {
                                    $this->pageTpl->assignIteration('iColor', 	'oneven');
                            }else{
                                    $this->pageTpl->assignIteration('iColor', 	'even');
                            }
                            $teller2++;
                            $this->pageTpl->assignIteration('iName2', $partEvents2['eventname']);

                            if($partEvents2['status'] == 1){
                                $this->pageTpl->assignIteration('iStatus2', 'PROGRESS');
                                $this->pageTpl->assignIteration('iStatusColor', 'progress');
                            }else if($partEvents2['status'] == 2){
                                $this->pageTpl->assignIteration('iStatus2', 'FINISHED');
                                $this->pageTpl->assignIteration('iStatusColor', 'finished');
                            }else{
                                 $this->pageTpl->assignIteration('iStatus2', 'NOT STARTED YET');
                                 $this->pageTpl->assignIteration('iStatusColor', 'setup');                                 
                            }
                            
                            $this->pageTpl->assignIteration('iParMem', $partEvents2['accepted_participants']);
                            
                            $this->pageTpl->refillIteration();
                            }
                            						
                        }					
					
                // parse iteration
                $this->pageTpl->parseIteration();
	
		
		// Page Specific Layout
                }else{
                    $this->mainTpl->assignOption('oNotLogged');
                    PlonkWebsite::redirect('index.php?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=login');
                }
		

                        
	}
        
        public function showProfile() 
	{	
            // Main Layout
                        
                // asisgn vars in our main layout tpl
                $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Profile');
                $this->mainTpl->assign('pageMeta', 		'');
                $this->mainTpl->assign('pageH2', 		'Profile');
                
                
                
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
                    
                    $getUserid = UsersDB::getUser(PlonkFilter::getGetValue('userid'));
                    
                    	
                    if( $getUserid['username'] == PlonkSession::get('name'))
                    {
                        $url = $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=users&' . PlonkWebsite::$viewKey .'=myprofile';
			PlonkWebsite::redirect($url);
                    }else {
                        $this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');
                        $this->pageTpl->assign('username', $getUserid['username']);
                    
                    }   
	
		
		// Page Specific Layout
                }else{
                    $this->mainTpl->assignOption('oNotLogged');
                }       
                        
                        $user = UsersDB::getUserInfoWithId(PlonkFilter::getGetValue("userid"));
                        
                         $this->pageTpl->assign('username', $user['username']);
                
                        $this->pageTpl->assign('url', $user['profilepic']);
                        $this->pageTpl->assign('firstname', $user['firstname']);
                        $this->pageTpl->assign('lastname', $user['name']);
                        $this->pageTpl->assign('email', $user['email']);
                        $this->pageTpl->assign('cellph', $user['cellphone']);
                
                        $teller = 0;
                        $orgEvents = UsersDB::getOrgEvents(PlonkFilter::getGetValue("userid"));
                        $this->pageTpl->setIteration('iOrgEvents');
                        
                        foreach($orgEvents as $orgEvent){
                            $this->pageTpl->assignIteration('iEventId', $orgEvent['id']);
                    
                            if($teller&1) {
                                    $this->pageTpl->assignIteration('iColor', 	'oneven');
                            }else{
                                    $this->pageTpl->assignIteration('iColor', 	'even');
                            }
                            $teller++;
                            $this->pageTpl->assignIteration('iName', $orgEvent['eventname']);

                            if($orgEvent['status'] == 1){
                                $this->pageTpl->assignIteration('iStatus', 'PROGRESS');
                                $this->pageTpl->assignIteration('iStatusColor', 'progress');
                                $this->pageTpl->assignIterationOption('oEdi');                                        
                            }else if($orgEvent['status'] == 2){
                                $this->pageTpl->assignIteration('iStatus', 'FINISHED');
                                $this->pageTpl->assignIteration('iStatusColor', 'finished');
                            }else{
                                 $this->pageTpl->assignIteration('iStatus', 'NOT STARTED YET');
                                 $this->pageTpl->assignIteration('iStatusColor', 'setup');
                                 $this->pageTpl->assignIterationOption('oGo');
                                 $this->pageTpl->assignIterationOption('oEdi');
                                 $this->pageTpl->assignIterationOption('oDel');
                                 
                            }
                            
                            $this->pageTpl->assignIteration('iParMem', $orgEvent['accepted_participants']);
                            
                            $this->pageTpl->refillIteration();						
                        }					
					
                // parse iteration
                $this->pageTpl->parseIteration();
                
                
                $teller2 = 0;
                        $partEvents = UsersDB::getPartEvents($user['id']);
                       
                        
                        
                        $this->pageTpl->setIteration('iPartEvents');
                        
                        foreach($partEvents as $partEvent){
                            
                            $partEventss = UsersDB::getPartEvents2($partEvent['eventid']);
                            
                            
                            foreach($partEventss as $partEvents2){
                                $this->pageTpl->assignIteration('iEventId2', $partEvents2['id']);
                    
                            if($teller2&1) {
                                    $this->pageTpl->assignIteration('iColor', 	'oneven');
                            }else{
                                    $this->pageTpl->assignIteration('iColor', 	'even');
                            }
                            $teller2++;
                            $this->pageTpl->assignIteration('iName2', $partEvents2['eventname']);

                            if($partEvents2['status'] == 1){
                                $this->pageTpl->assignIteration('iStatus2', 'PROGRESS');
                                $this->pageTpl->assignIteration('iStatusColor', 'progress');
                            }else if($partEvents2['status'] == 2){
                                $this->pageTpl->assignIteration('iStatus2', 'FINISHED');
                                $this->pageTpl->assignIteration('iStatusColor', 'finished');
                            }else{
                                 $this->pageTpl->assignIteration('iStatus2', 'NOT STARTED YET');
                                 $this->pageTpl->assignIteration('iStatusColor', 'setup');                                 
                            }
                            
                            $this->pageTpl->assignIteration('iParMem', $partEvents2['accepted_participants']);
                            
                            $this->pageTpl->refillIteration();
                            }
                            						
                        }					
					
                // parse iteration
                $this->pageTpl->parseIteration();
                
                
                
                
                
		

                        
	}
        
        public function showList() 
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
                
                $users = UsersDB::getUsers();	       
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
                    $this->pageTpl->refillIteration();						
		}					
					
                // parse iteration
                $this->pageTpl->parseIteration();
                	
		
		// Page Specific Layout
                        
	}
	
		
}

// EOF