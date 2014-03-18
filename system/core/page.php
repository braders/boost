<?php
/**
 * 
 * Page class is extended by all site pages
 * 
 * @author Bradley Taylor 
 */
	class page{
		
		protected $module;
		protected $model;
		protected $page;
		protected $view;
	
		
		function __construct(){
			$this->set_vars();
			$this->read_slug();
			$this->load_model();
			$this->controller();
			//$this->load_view($this->view['data'], $this->view['file'], $this->view['loc']);
		}
		
		protected function set_vars(){
			global $BoostRegistry;
			$this->core = $BoostRegistry;
			$this->auth =& $BoostRegistry->auth;
			$this->module = get_class($this);
			
		}
	
		protected function set_view($data = Null, $file = Null, $loc = Null, $page = Null){
			$this->view['data'] = $data;
			$this->view['file'] = $file;
			$this->view['loc'] = $loc;
			$this->page['page'] = $page;
			if(is_null($page['title'])){
				$this->page['title'] = 'collection';
			}
			else{
				$this->page['title'] = $page['title'].' | collection';
			}
		}
	
		protected function load_view($data = Null, $file = Null, $loc = Null){
		if (isset($data)){
			foreach ($data as $name => $result){
				$$name = $data[$name];
			}
		}
			
			if(is_null($file)){
				$file = $this->module.'.php';
			}
			$site_path = site_path.'/pages/'.$this->module.'/'.$file;
			if(file_exists($site_path)){
				include($site_path);
			}

		}
		
		public static function template_functions(){
			function Boost_block($block){
				//echo $block;
				$class = $block.'_block';
				if (!class_exists($class)){
					include site_path.'/blocks/'.$block.'/controller.php';
					new $class;
				}
				else{
					new $class;
				}
			}
			function is_logged_in(){
				global $BoostRegistry;
				if($BoostRegistry->auth->get_uid() == 0){
					return 0;
				}
				else{
					return 1;
				}
			}
			function name(){
				global $BoostRegistry;
				if($BoostRegistry->auth->get_uid() == 0){
					return 0;
				}
				else{
					//return 'hello';
					return $BoostRegistry->auth->get_name();
				}
			}
		}
		
		public static function load_template_file($file){
			$file_path = site_path.'/pages/'.$file.'.php';
			if(file_exists($file_path)){
				include($file_path);
			}
		}
		
		protected function load_model(){
			$path = site_path.'/pages/'.$this->module.'/model.php';
			if(file_exists($path)){
				include($path);
				$classname = $this->module.'_model';
				$this->model = new $classname();
			}
		}
		
		public static function show404(){
			header("HTTP/1.0 404 Not Found");
			self::load_template_file('404');
		}	
		
		protected function redirect($path){
			//echo 'redirect attempted';
			header('Location:'.$path) ;
		}
		
		protected function read_slug(){
			$url = $this->core->url->return_url();
			$this->slug = $url;
		}
	}
?>