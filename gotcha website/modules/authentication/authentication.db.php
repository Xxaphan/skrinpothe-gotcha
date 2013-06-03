<?php

/**
 * TodoList - Authentication DB Class / Model
 * 
 * @author Bramus Van Damme <bramus.vandamme@kahosl.be>
 * 
 */

class AuthenticationDB {
	
	/**
	 * Verifies a username/password combo
	 * @param string $username
	 * @param string $password
	 * @return 
	 */
	public static function verifyLoginCredentials($username, $password) {
		
		// rework params
		$username = (string) $username;
		$password = (string) $password;	

		// get DB instance
		$db = PlonkWebsite::getDB();
		
		// query DB
		
		$user = $db->retrieve(sprintf(
			'SELECT * FROM gotcha_users WHERE username = "%s" AND password = "%s"',
			$db->escape($username),
			$db->escape(md5($password))
		));
		
		var_dump($user);
		
		// return the result
		return (sizeof($user) == 1) ? true : false;
		
		
	}

	public static function register($lastname, $firstname, $email, $cellphone, $username, $password) {
			
		$db = PlonkWebsite::getDB();
		$sql = ("INSERT INTO gotcha_users (name, firstname, email, cellphone, username, password) VALUES ('".$lastname."','".$firstname."','".$email."','".$cellphone."','".$username."','".$password."')");
		
		//$sql = ("INSERT INTO gotcha_users (name, firstname, email, cellphone, username, password) VALUES ('".$lastname."','".$firstname."','".$email."','".$cellphone."','".$username."','".$password."')");
		$db->execute($sql);
	}

	
}

// EOF