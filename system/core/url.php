<?php
/**
 *
 * parses the url (all files go through index.php so we need to do it ourselves)
 * 
 * @author Bradley Taylor 
 */
	class url{
	
		private $file;
		private $url;
		private $url_sections;
	
		function __construct(){
			$this->seperate_url();
		}
		
		private function get_file(){
			$file = strip_tags($_SERVER['SCRIPT_NAME']);
			$this->file = $file;
			return $this->file;
		}
		private function get_url(){
			$url = strip_tags($_SERVER['REQUEST_URI']);
			$this->url = $url;
			return $this->url;
		}
		private function seperate_url(){
		
			$file = $this->get_file();
			$file_array=explode("/",$file);//get array of folders
			array_pop($file_array); //remove index.php
			array_shift($file_array); //the first one is empty anyway
			$file_count = count($file_array);

			//url
			$url = $this->get_url();
			$url_array=explode("/",$url);//get array of folders
			array_shift($url_array); //the first one is empty anyway
			$url_count = count($url_array);
			
			//url_sections
			$url_diff = $url_count - $file_count;
			$sections = array();
			for ($i = $file_count, $x = 0 ; $i < $url_count; $i++, $x++){
				$sections[$x] = $url_array[$i];//append to end of sections array
			}
			
			//remove ? if exists
			if (strpos(end($sections),'?') !== false) {
				$str = substr(end($sections),0, strpos(end($sections), "?"));
				$length = count($sections);
				$sections[$length - 1] = $str;
			}
			
			$sections = array_pad($sections, 4, Null); //make array 4 long as urls can be 4 long - (controller, id, sub-data, sub-data)
			$this->url_sections = $sections;
		}
		
		public function return_url(){
			return $this->url_sections;
		}

	}

?>