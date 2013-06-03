<?php

		/*
		 * Mysql Configuration
		 */
		
		$sql_host = 'localhost';
		$sql_name = 'DB_10003225';
		$sql_user = 'U_10003225';
		$sql_pass = 'Zxksupje3htsEAZM';

		/*
		 * Trying to connect to mysql server.
		 * Output Temporary error if unable to.
		 */
		if (!@mysql_connect($sql_host,$sql_user,$sql_pass)) {
			$results = Array(
				'head' => Array(
					'status' 		=> '0',
					'error_number'	=> '500', 
					'error_message' => 'Temporary Error.'.
						'Our server might be down, please try again later.'
				),
				'body' => Array ()
			);
			$errors=1;
		}
		
		/*
		 * Trying to enter the database.
		 * Output Temporary error if unable to.
		 */
		if (!@mysql_select_db($sql_name)) {
			$results = Array(
				'head' => Array(
					'status' 		=> '0',
					'error_number'	=> '500', 
					'error_message' => 'Temporary Error.'.
						'Our server might be down, please try again later.'
				),
				'body' => Array ()
			);
			$errors=1;
		}
		
		/*
		 * If no errors were found during connection
		 * let's proceed with out queries
		 */
		if (!$errors) 
			switch ($_GET['method']) {
				
				case 'update' :	
						$query = '
							UPDATE `users_location`
							SET longt="'.mysql_real_escape_string($_GET['longt']).'",
								lat="'.mysql_real_escape_string($_GET['lat']).'",
							WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'"
						';
						if (!@mysql_query($query))
							$results = Array(
								'head' => Array(
									'status' 		=> '0',
									'error_number'	=> '602', 
									'error_message' => 'Update Failed. '.
										'Probably wrong qfd supplied.'
								),
								'body' => Array ()
							);
						else {
							$query = '
								SELECT `user`
								FROM `users_location`
								WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'"
								LIMIT 1
							';
							if (!$go = @mysql_query($query)) {
								$results = Array(
									'head' => Array(
										'status' 		=> '0',
										'error_number'	=> '603', 
										'error_message' => 'Select Failed. '.
											'Probably wrong test supplied.'
									),
									'body' => Array ()
								);
							} else {
								$fetch = mysql_fetch_row($go);
								$return = $fetch[0];
								$results = Array(
									'head' => Array (
										'status' => 1
									),
									'body' => Array (
										'id' => $return
									)
								);
							}
						}
					break;
				case 'get' :
						$query = '
							SELECT `username`
							FROM `gotcha_users`
							
								WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'"
						';
						if (!$go = @mysql_query($query)) {
							$results = Array(
								'head' => Array(
									'status' 		=> '0',
									'error_number'	=> '604', 
									'error_message' => 'Select Failed. '.
										'Probably wrong name supplied.'
								),
								'body' => Array ()
							);
						} else {
							$fetch = mysql_fetch_row($go);
							$return = Array($fetch[0],$fetch[1]);  
							$results = Array(  
								'body' => Array (  
									'username'    => $return[0]
								)  
							); 
						}
					break;

					case 'selecttarget' :
						$query = '
							SELECT `target`
							FROM `gotcha_event_participants`
							
								WHERE `userid` = "'.mysql_real_escape_string($_GET['id']).'"
						';
						if (!$go = @mysql_query($query)) {
							$results = Array(
								'head' => Array(
									'status' 		=> '0',
									'error_number'	=> '604', 
									'error_message' => 'Select Failed. '.
										'Probably wrong name supplied.'
								),
								'body' => Array ()
							);
						} else {
							$fetch = mysql_fetch_row($go);
							$return = Array($fetch[0],$fetch[1]);  
							$results = Array(  
								'body' => Array (  
									'target'    => $return[0]
								)  
							); 
						}
					break;

					case 'selecttargetinfo' :
						$query = '
						select gotcha_users.username as username, gotcha_user_location.longt as longti, gotcha_user_location.lat as lati from gotcha_user_location
						inner join gotcha_users on gotcha_user_location.user = gotcha_users.id where gotcha_user_location.user = "'.mysql_real_escape_string($_GET['id']).'"
						';
						if (!$go = @mysql_query($query)) {
							$results = Array(
								'head' => Array(
									'status' 		=> '0',
									'error_number'	=> '604', 
									'error_message' => 'Select Failed. '.
										'Probably wrong name supplied.'
								),
								'body' => Array ()
							);
						} else {
							$fetch = mysql_fetch_row($go);
							$return = Array($fetch[0],$fetch[1],$fetch[2]);  
							$results = Array(  
								'body' => Array (  
									'username'    => $return[0],
									'longti'    => $return[1],
									'lati'    => $return[2]
								)  
							); 
						}
					break;
			}
		
		mysql_close();
			
		switch ($_GET['format']) {
			case 'xml' :
					@header ("content-type: text/xml charset=utf-8");
					$xml = new XmlWriter();
					$xml->openMemory();
					$xml->startDocument('1.0', 'UTF-8');
					$xml->startElement('callback');
					$xml->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
					$xml->writeAttribute('xsi:noNamespaceSchemaLocation','schema.xsd');
					function write(XMLWriter $xml, $data){
							foreach($data as $key => $value){
									if(is_array($value)){
											$xml->startElement($key);
											write($xml, $value);
											$xml->endElement();
											continue;
									}
									$xml->writeElement($key, $value);
							}
					}
					write($xml, $results);

					$xml->endElement();
					echo $xml->outputMemory(true);
				break;
			case 'json' :
					@header ("content-type: text/json charset=utf-8");
					echo json_encode($results);
				break;
			case 'php' :
					header ("content-type: text/php charset=utf-8");  
					echo serialize($results);  
				break;
		}

?>
