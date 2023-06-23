<?php
	/**
	* Database Connection
	*/

	//Creating a DB Connection using a DBConnect Class
	class DbConnect {
		//Setting the server name to localhost
		private $server = 'localhost';
		//Setting the database name to decks
		private $dbname = 'my_madmark';
		//Setting the username of the database to root
		private $user = 'madmark';
		//Setting the password of the database to root
		private $pass = '';

		//Calling a public connect function
		public function connect() {
			try {
				//Setting a variable conn using the PDO framework
				$conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				//Using the PDO framework to error reporting mode and to throw PDO exceptions
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//Returning the conn variable
				return $conn;
			} //Catching exceptions and printing Database Error: followed by the error that occurred 
			catch (\Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}
        
	}
?>