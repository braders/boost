<?php
/**
 * 
 * class responsible for loading and formatting the correct MVC controllers
 * 
 * @author Bradley Taylor 
 */
	class loader{

		private $routes;
		private $url;
		private $controller;
	
		function __construct(){
			//enable gzip
			ob_start("ob_gzhandler");
			
			//load route
			$this->route();
			
			//load controller
			$this->load_controller();
			
			//end of output
			ob_end_flush();
		}
		
		private function route(){
		//load the route, get the url, then decide controller
			global $BoostRegistry;
			$this->url = $BoostRegistry->url->return_url();
			$this->routes = include(site_path.'/routes.php');
			foreach ($this->routes as $path => $controller) {
				if ($this->url[0] == $path){
					$this->controller = $controller;
				}
			}
		}
		private function load_controller(){
		ob_start();
			page::template_functions();
				$path = site_path.'/pages/'.$this->controller;		
				$controller = $path.'/controller.php';
				if (file_exists($controller)){
					include ($controller);
					new $this->controller();
				}
				else{
					page::show404();
				}
			$output = ob_get_contents();
			ob_end_clean();
			
		page::load_template_file('header');
		//do it as a output buffer, so model runs before header/footer output displayed
		echo $output;
		page::load_template_file('footer');

		
	}
}
?>