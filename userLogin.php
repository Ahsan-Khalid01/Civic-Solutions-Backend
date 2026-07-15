<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");
$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if(isset($data->email) && isset($data->password)) {
    $email = $data->email;
    $password = $data->password;
    $query = "SELECT * FROM userregistartion WHERE Email='$email' AND Password='$password'";
    $process_query = mysqli_query($conn, $query);

    if ($process_query && mysqli_num_rows($process_query) > 0) {
        $user = mysqli_fetch_assoc($process_query);
        echo json_encode(["success" => true, "user" => $user]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No data received."]);
}
?>