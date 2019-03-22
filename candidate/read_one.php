<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/candidate.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$candidate = new Candidate($db);

// set ID property of record to read
$candidate->email = isset($_GET['email']) ? $_GET['email'] : die();
 
// query products
$stmt = $candidate->readOne();
//$num = $stmt->rowCount();
 
// check if more than 0 record found
if($candidate->firstName != null){
 
    // candidates array
    $candidates_arr=array(
        "email" => $candidate->email,
        "firstName" => $candidate->firstName,
        "lastName" => $candidate->lastName,
        "job" => $candidate->job,
        "status" => $candidate->status,
        "recruiter" => $candidate->recruiter
    );
 
    
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($candidates_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "Candidate does not exists.")
    );
}