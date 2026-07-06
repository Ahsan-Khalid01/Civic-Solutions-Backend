<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");
$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if(isset($data->loginId) && isset($data->password)) {
    $loginId = $data->loginId;
    $password = $data->password;
    $query = "SELECT * FROM department WHERE loginId='$loginId' AND password='$password'";
    $process_query = mysqli_query($conn, $query);

    if ($process_query && mysqli_num_rows($process_query) > 0) {
        $dept = mysqli_fetch_assoc($process_query);
        echo json_encode(["success" => true, "department" => $dept]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid ID or password."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No data received."]);
}
?>