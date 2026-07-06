<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");
$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if(isset($data->id)) {
    $id = $data->id;
    $query = "DELETE FROM issues WHERE id = '$id'";
    $process_query = mysqli_query($conn, $query);

    if ($process_query) {
        echo json_encode(["success" => true, "message" => "Issue deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Delete failed: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No id received."]);
}
?>