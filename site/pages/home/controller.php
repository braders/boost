<?php
/**
 * @author Bradley Taylor
 * @author Josie Hughes
 * @author Craig Gibbs
 */
	class home extends page{
		function controller(){

			/*see:
				http://stackoverflow.com/questions/7424913/how-to-count-the-number-of-instances-of-each-foreign-key-id-in-a-table
			*/
			$data['featured'] = $this->model->get_featured();
			$this->load_view($data);


		}
	}
?>