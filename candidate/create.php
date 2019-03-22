<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate candidate object
include_once '../objects/candidate.php';
 
$database = new Database();
$db = $database->getConnection();
 
$candidate = new Candidate($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->email) &&
    !empty($data->lastName) &&
    !empty($data->firstName) &&
    !empty($data->job) &&
    !empty($data->status) &&
    !empty($data->recruiter)
){
 
    // set product property values
    $candidate->email = $data->email;
    $candidate->lastName = $data->lastName;
    $candidate->firstName = $data->firstName;
    $candidate->job = $data->job;
    $candidate->status = $data->status;
    $candidate->recruiter = $data->recruiter;
 
    // create the candidate
    if($candidate->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Candidate was created."));
    }
 
    // if unable to create the candidate, tell the user
    else {
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create candidate."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create candidate. Data is incomplete."));
}
?>