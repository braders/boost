<?php
/**
 * 
 * Provides a plugin-like system
 * 
 * @author Bradley Taylor 
 * @deprecated
 */
	class block{
		

		public function __construct(){
			global $BoostRegistry;
			$this->auth =& $BoostRegistry->auth;

			$this->controller();
		}
		
	}
?>