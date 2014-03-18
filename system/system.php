<?php
/**
 * 
 * Start the code running
 * 
 */

	//load classes on instantiation
	function autoload($class_name) {
		if (!class_exists($class_name)){
			/*if  (! include system_path.'/core/'.$class_name . '.php'){
				throw new Exception('could not load class');
			}*/
			if (file_exists(system_path.'/core/'.$class_name . '.php')){
				include system_path.'/core/'.$class_name . '.php';
			}
		}
	}
	spl_autoload_register('autoload');

	require system_path.'/password.php';
	
	
	//this will contain everything for the application, to avoid filling the global namespace.
	$BoostRegistry = new stdClass;
	
	
	//load the auth class
	$BoostRegistry->auth = new auth();
	
	//parse the url
	$BoostRegistry->url = new url();
	
	//load the app
	$BoostRegistry->loader = new loader();
?>