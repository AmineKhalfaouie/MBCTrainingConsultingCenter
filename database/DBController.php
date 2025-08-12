<?php
class DBController {
    // Database Connection Properties
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $database = "consulting";

    // Connection Property
    public $con = null;

    // Call Constructur
    public function __construct() {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if($this->con->connect_error) {
            echo "Fail" . $this->con->connect_error;
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    public function closeConnection() {
        if($this->con != null) {
            mysqli_close($this->con);
            $this->con = null;
        }
    }
}
?>