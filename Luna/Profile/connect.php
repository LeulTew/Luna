<?php
class DBConnect {
    private $host = 'localhost';
    private $user = 'root';
    private $pw = '';
    private $db = 'luna';

    function getConnection(){
        $con = new mysqli($this->host, $this->user, $this->pw, $this->db);
        if ($con->connect_errno) {
            die('Error occurred: ' . $con->connect_error);
        }
        return $con;
    }
}
?>
