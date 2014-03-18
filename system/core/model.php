<?php
/**
 * 
 * extended by all models in site directory
 * 
 * @author Bradley Taylor 
 */
	class model{
		
		function __construct(){
			global $BoostRegistry;
			$this->db = new database();
			$this->auth =& $BoostRegistry->auth;

		}
	
	}
?>