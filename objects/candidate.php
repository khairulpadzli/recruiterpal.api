<?php
class Candidate{
    // database connection and table name
    private $conn;
    private $table_name = "tbl_candidate";
 
    // object properties
    public $email;
    public $firstName;
    public $lastName;
    public $job;
    public $status;
    public $recruiter;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    public function read(){
        //select all data
        $query = "SELECT
                    email, firstName, lastName, job_id, status, recruiter
                FROM
                    " . $this->table_name . "
                ORDER BY firstName";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    // used when filling up the update product form
    function readOne(){
 
        // query to read single record
        $query = "SELECT
                email, firstName, lastName, job_id, status, recruiter
            FROM
                " . $this->table_name . "
                
            WHERE email = ?";
 
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
 
        // bind id of product to be updated
        $stmt->bindParam(1, $this->email);
 
        // execute query
        $stmt->execute();
 
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // set values to object properties
        $this->email = $row['email'];
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->job = $row['job_id'];
        $this->status = $row['status'];
        $this->recruiter = $row['recruiter'];
    }

    // create candidate
    function create(){
 
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
                SET
                email=:email, firstName=:firstName, lastName=:lastName, job_id=:job_id, recruiter=:recruiter, status=:status";
 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->firstName=htmlspecialchars(strip_tags($this->firstName));
        $this->lastName=htmlspecialchars(strip_tags($this->lastName));
        $this->job=htmlspecialchars(strip_tags($this->job));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->recruiter=htmlspecialchars(strip_tags($this->recruiter));
 
        // bind values
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":job_id", $this->job);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":recruiter", $this->recruiter);

        // execute query
        if($stmt->execute()){
            return true;
        }
 
        return false;
     
    }
}
?>