<?php

/**
* Gotcha Project - Gotcha Project DB Class / Model
* 
* @author Skrin Pothé
* 
*/

require_once './library/plonk/filesystem/directory.php';



class SplashController extends PlonkController {

	

	/**
	 * The views allowed for this module
	 * @var array
	 */	
	protected $views = array(
		'splash'		
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
	public function showSplash() 
	{	
		
		// Main Layout
                        
			// asisgn vars in our main layout tpl
			$this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Splash');
			$this->mainTpl->assign('pageMeta', 		'');
			$this->mainTpl->assign('pageH2', 		'Splash');	
					
					
		
		// Page Specific Layout
                        
	}
	
		
}

// EOF