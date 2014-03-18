<?php
/**
 * 
 * Provides methods for authenticating the user; stores auth data as session cookie
 * 
 * @author Bradley Taylor
 * @todo implement is_admin method
 * @todo rehash password with strongest current algortith is required upon logon	
 */
	class auth{

		private $id;
		
		function __construct(){
			session_start();
			if (isset($_SESSION['id'])){
				$this->id = $_SESSION['id'];
				$this->fname = $_SESSION['fname'];
				$this->lname = $_SESSION['lname'];
				$this->email = $_SESSION['email'];
				$this->permission = $_SESSION['permission'];
			}
			else{
				$this->id = 0;
				$this->fname = 0;
				$this->lname = 0;
				$this->email = 0;
				$this->permission = 0;
			}
		}
		
		public function log_out(){
			$this->id = 0;
			$_SESSION['id'] = 0;
		}
		
		public function log_in($details){
			$_SESSION['id'] = $details['user_id'];
			$_SESSION['fname'] = $details['fname'];
			$_SESSION['lname'] = $details['lname'];
			$_SESSION['email'] = $details['email'];
			$_SESSION['permission'] = $details['permission'];
			
		}
		
		public function get_uid(){
			return $this->id;
		}
		public function get_name(){
			$name = $this->fname . " " . $this->lname;
			return $name;
		}
		
		public function is_admin(){
			
		}
		
		public function hash_pass($pass){
			return password_hash("$pass", PASSWORD_DEFAULT);
		}
		public function info_pass($pass){
			return password_get_info($pass);
		}
		public function verify_pass($pass,$hash){
			return password_verify($pass,$hash);
		}
		public function rehash_pass($pass){
			
		}

	}
?>