<?php

/**
 * 
 * @author RFIDTEAM
 * 
 */

// include project specific includes
require_once './core/includes/config.php';
require_once './core/includes/functions.php';

// include Plonk library
require_once './library/plonk/plonk.php';
require_once './library/plonk/website/website.php';
require_once './library/plonk/filter/filter.php';




try {
	$website = new PlonkWebsite(
		array('splash','home', 'authentication','users','events', 'locations')
	);
	
} catch (Exception $e) { 	
	if (!defined('DEBUG') || (DEBUG === true))
	{			
		echo '<h1>Exception Occured</h1><pre>';
		throw $e;
	} else exit('There was an error with processing your request - Please retry.');
}

// EOF


