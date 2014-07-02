<?php
/**
 * 
 *Database wrapper for PDO
 * 
 * @author Bradley Taylor 
 * @see http://stackoverflow.com/questions/6740153/simple-pdo-wrapper
 * @todo make db/ stmt properties private - currently public for de-bugging purposed
 */
	class database{

		public $db;
		public $stmt;
		
		private $dbhost = "localhost";
		private $dbname = "Your Database";
		private $dbuser = "Your User";
		private $dbpass = "Your Password";

		function __construct(){
			$this->connect();
		}

		private function connect(){
			try {  
				$this->db = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass); 
				$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //return all queries as fetch_accoc	
			}  
			catch(PDOException $e) {  
				echo $e->getMessage();  
			}  
		}
		

		public function query($query) {
			$this->stmt = $this->db->prepare($query);
			return $this;
		}

		public function bind($pos, $value, $type = null) {

			if( is_null($type) ) {
				switch( true ) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($pos, $value, $type);
			return $this;
		}

		public function execute() {
			return $this->stmt->execute();
		}

		public function resultset() {
			$this->execute();
			return $this->stmt->fetchAll();
		}

		public function single() {
			$this->execute();
			return $this->stmt->fetch();
		}
	}
?>
