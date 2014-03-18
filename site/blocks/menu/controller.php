<?php
	class menu_block extends block{
		
		function controller(){
			echo '
				<ul>
					<li><a href="'.site_root.'">Home</a></li>
				</ul>
			';
		}
	}

	
?>