<?php
/**
 * @author Bradley Taylor
 */
	class home_model extends model{
	
		function get_featured(){
			return $this->db->query("SELECT * FROM featured LEFT JOIN product ON featured.product = product.product_id")->resultset();
		}


	}
	
?>