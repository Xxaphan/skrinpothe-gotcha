<?php

/**
* Gotcha Project - Gotcha Project DB Class / Model
* 
* @author Skrin Pothé
* 
*/

require_once './library/plonk/filesystem/directory.php';



class LocationsController extends PlonkController {

	

	/**
	 * The views allowed for this module
	 * @var array
	 */	
	protected $views = array(
		'locations'		
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
	public function showLocations() 
	{	
                $this->mainTpl->assign('pageTitle', 	'Gotcha Mobile - Locations');
                $this->mainTpl->assign('pageMeta', 		'');
                $this->mainTpl->assign('pageH2', 		'Locations');
            
                echo"test";
                $locations = LocationsDB::getLocations();
		
                var_dump($locations);     
					
					
		
		// Page Specific Layout
                        
	}
	
		
}

// EOF