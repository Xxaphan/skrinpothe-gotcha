<?php

/**
* Gotcha Project - Gotcha Project DB Class / Model
* 
* @author Skrin Pothé
* 
*/

require_once './library/plonk/filesystem/directory.php';



class HomeController extends PlonkController {

	

	/**
	 * The views allowed for this module
	 * @var array
	 */	
	protected $views = array(
		'home'		
	);

	
	/**
	 * The actions allowed for this module
	 * @var array
	 */
	protected $actions = array(	
		
	);
	


        
	/**
	 * Our default view
	 * @return 
	 */
	public function showHome() 
	{	
                $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Home');
                $this->mainTpl->assign('pageMeta', 		'');
                $this->mainTpl->assign('pageH2', 		'Home');
            
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)){
		// Main Layout
                        
			// asisgn vars in our main layout tpl
			
                        $this->mainTpl->assign('username', PlonkSession::get('name'));
                        $this->mainTpl->assignOption('oLogged');
                         

                }else{
                     $this->mainTpl->assignOption('oNotLogged');
                }
                        
					
					
		
		// Page Specific Layout
                        
	}
	
		
}

// EOF