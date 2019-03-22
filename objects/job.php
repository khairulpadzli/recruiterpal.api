<?php
class Job{
    // database connection and table name
    private $conn;
    private $table_name = "tbl_job";
 
    // object properties
    public $id;
    public $job_title;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    public function read(){
        //select all data
        $query = "SELECT
                    id, job_title
                FROM
                    " . $this->table_name . "
                ORDER BY id";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
}
?>