<?php

/** Configuration for: Database Connection */
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'binary_choice_game');
define('DB_USER', 'root');
define('DB_PASS', '');

/** Function to get the client IP address */
function ClientIP() {
	return getenv('HTTP_CLIENT_IP')   ? : getenv('HTTP_X_FORWARDED_FOR') ? :
		   getenv('HTTP_X_FORWARDED') ? : getenv('HTTP_FORWARDED_FOR') ? :
		   getenv('HTTP_FORWARDED')   ? : getenv('REMOTE_ADDR');
}

/** Function to print error message as JSON and exit */
function Error($msg, $error = true) {
	echo json_encode(array('error' => $error, 'error_msg' => $msg));
	if ($error == true)
		exit;
}

/** Class User - Handles SignUp, SignIn, SignOut */
class User {
	private $dbConn = NULL;

	public function __construct() {
		$this->dbConn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($this->dbConn->connect_errno)
			$this->Error($this->dbConn->connect_error);
		if (!$this->dbConn->set_charset("utf8"))
			$this->Error($this->dbConn->error);
		session_start();
		session_regenerate_id();
		if (isset($_REQUEST["signup"]))
			$this->SignUp();
		if (isset($_REQUEST["signin"]))
			$this->SignIn($_POST['username'], $_POST['password']);
		if (isset($_REQUEST["signout"]))
			$this->SignOut();
		echo json_encode(array('error' => false));
	}

	private function Error($msg) {
		echo json_encode(array('error' => true, 'error_msg' => $msg));
		exit;
	}

	private function CheckUser($user) {
		$username = $this->dbConn->real_escape_string($user);
		$sql = "SELECT * FROM users WHERE username = '$username';";
		$query = $this->dbConn->query($sql);
		return ($query->num_rows == 1) ? array(true, $query) : array(false, $username);
	}

	private function SignUp() {
		$result = $this->CheckUser($_POST['username']);
		if ($result[0] == true)
			$this->Error("Username already exists");
		$pass_hash = password_hash($this->dbConn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
		$keys = array();
		$vals = array();
		foreach ($_POST as $key => $val) {
			$esc_val = $this->dbConn->real_escape_string($val);
			$keys[] = "$key";
			$vals[] = ($key == "password") ? "'$pass_hash'" : "'$esc_val'";
		}
		$sql = "INSERT INTO users (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $vals) . ");";
		if ($this->dbConn->query($sql) == false)
			$this->Error($this->dbConn->error);
		$this->SignIn($_POST['username'], $_POST['password']);
	}

	private function SignIn($user, $pass) {
		$result = $this->CheckUser($user);
		if ($result[0] == false)
			$this->Error("Username doesn't exist");
		$result_row = $result[1]->fetch_object();
		$password = $this->dbConn->real_escape_string($pass);
		if (!password_verify($password, $result_row->password))
			$this->Error("Password incorrect");
		$id = session_id();
		$ip = ClientIP();
		$date = date('Y-m-d H:i:s');
		$sql = "INSERT INTO signin_log (sessid, username, ip_address, timestamp) VALUES ('$id', '$result_row->username', '$ip', '$date');";
		$this->dbConn->query($sql);
		$_SESSION['loggedin'] = 1;
	}

	private function SignOut() {
		session_unset();
		session_destroy();
	}
}

/** Object Declaration */
new User();

?>