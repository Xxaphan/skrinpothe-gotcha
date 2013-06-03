<?php

/**
 * authentication - authentication Controller
 * 
 * @author Skrin Pothé <skrin.pothe@kahosl.be>
 * 
 */
	
class AuthenticationController extends PlonkController {

	/**
	 * The views allowed for this module
	 * @var array
	 */	
	protected $views = array(
		'login',
		'logout',
		'register'
	);

	
	/**
	 * The actions allowed for this module
	 * @var array
	 */
	protected $actions = array(
		'login',
		'register'
	);
	
	
	/**
	 * The form errors
	 * @var array
	 */
	private $formErrors = array();
        


	/**
	 * register action
	 */
	public function doRegister() {
		$lastname = (string) PlonkFilter::getPostValue('lastname', null, '');
		$firstname = (string) PlonkFilter::getPostValue('firstname', null, '');
		$email = (string) PlonkFilter::getPostValue('email', null, '');
		$cellphone = (string) PlonkFilter::getPostValue('cellphone', null, '');
		$username = (string) PlonkFilter::getPostValue('username', null, '');
		$password = (string) PlonkFilter::getPostValue('password', null, '');

		AuthenticationDB::register($lastname, $firstname, $email, $cellphone, $username, $password);

		$url = $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=users&' . PlonkWebsite::$viewKey .'=myprofile';
			PlonkWebsite::redirect($url);

	}
	
	
	/**
	 * Login action
	 */
	public function doLogin() {
		
		// extract sent in username & password
		$username = (string) PlonkFilter::getPostValue('username', null, '');
		$password = (string) PlonkFilter::getPostValue('password', null, '');

		
		// username & password are valid
		if (($username != '') && AuthenticationDB::verifyLoginCredentials($username, $password)) {
			
			// set loggedin state & username
			PlonkSession::set('loggedIn', true);
			PlonkSession::set('name', $username);
			$url = $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=users&' . PlonkWebsite::$viewKey .'=myprofile';
			PlonkWebsite::redirect($url);
		} 
		
		// username & password are not valid
		else {
		    
			PlonkSession::set('loggedIn', false);
			
			// set error
			$this->formErrors[] = 'Invalid username/password combination used';
                        $url = $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=login';
			PlonkWebsite::redirect($url);
			
		}	
		
	}

	/**
	 * Processes the errors
	 */
	public function processErrors() {
	
		// Ooh, we've got errors
		if (sizeof($this->formErrors) > 0) {
			
			// assign the option
			$this->pageTpl->assignOption('oErrors');
			
			// set the iteration
			$this->pageTpl->setIteration('iErrors');
		
			// loop all items and store 'm into the template iteration
			foreach ($this->formErrors as $error) {
				
				// assign vars
				$this->pageTpl->assignIteration('error', $error);
				
				// refill iteration
				$this->pageTpl->refillIteration();
				
			}
			
			// parse iteration
			$this->pageTpl->parseIteration();
			
		}
		
	}	
	
	
	/**
	 * Shows (or doesn't show) the logout link
	 * @return 
	 */
	public function processLogoutLink() {
		
		// we are logged in, show it
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
			
			// assign the logout link option
			$this->mainTpl->assign('logoutLink', $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=logout');
			$this->mainTpl->assignOption('oLogout');
			
		}
		
		
	}
	
	
	/**
	 * The login view
	 */
	public function showLogin() {
	
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)){
                    PlonkWebsite::redirect('index.php?' . PlonkWebsite::$moduleKey . '=users&' . PlonkWebsite::$viewKey .'=myprofile');
                }else{
		// Main Layout
		
			// assign vars in our main layout tpl
			$this->mainTpl->assign('pageTitle', 'Gotcha Mobile - Log in');
			$this->mainTpl->assign('pageMeta', '');
                        
                        $this->mainTpl->assignOption('oNotLogged');
                        
		// Page Layout
		
			// The errors
				$this->processErrors();
				
			// The logout link
				$this->processLogoutLink();
				
			// form URL
				$this->pageTpl->assign('formUrl', $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey . '=login');
				$this->pageTpl->assign('registerUrl', $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey . '=register');
		
                }			
		
	}
	
	
	/**
	 * The logout view
	 */
	public function showLogout() {	
		
		PlonkSession::destroy('loggedIn');
		// redirect to the login page
		PlonkWebsite::redirect($_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey .'=login');
		
	}

	public function showRegister() {
	
		if (PlonkSession::exists('loggedIn') && (PlonkSession::get('loggedIn') === true)) {
                    PlonkWebsite::redirect('index.php?' . PlonkWebsite::$moduleKey . '=users&' . PlonkWebsite::$viewKey .'=myprofile');
                }else{
                    
		// Main Layout
		
			// assign vars in our main layout tpl
			$this->mainTpl->assign('pageTitle', 'Gotcha Mobile - Register');
			$this->mainTpl->assign('pageMeta', '');
                        
                         $this->mainTpl->assignOption('oNotLogged');
		// Page Layout
		
			// The errors
				$this->processErrors();
				
			// The logout link
				$this->processLogoutLink();
				
			// form URL
				$this->pageTpl->assign('formUrl', $_SERVER['PHP_SELF'] . '?' . PlonkWebsite::$moduleKey . '=authentication&' . PlonkWebsite::$viewKey . '=register');
                }




						
		
	}

	


	
}

// EOF
