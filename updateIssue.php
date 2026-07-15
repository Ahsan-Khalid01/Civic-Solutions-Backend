<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");
$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if(isset($data->id) && isset($data->title) && isset($data->category) && isset($data->location) && isset($data->priority) && isset($data->description)) {

    $id = $data->id;
    $title = $data->title;
    $category = $data->category;
    $location = $data->location;
    $priority = $data->priority;
    $description = $data->description;

    $query = "UPDATE issues SET title='$title', category='$category', location='$location', priority='$priority', description='$description' WHERE id='$id'";
    $process_query = mysqli_query($conn, $query);

    if ($process_query) {
        echo json_encode(["success" => true, "message" => "Issue updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Update failed: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
}
?>