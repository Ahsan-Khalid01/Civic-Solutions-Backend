<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");
$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if(isset($data->Email) && isset($data->Phone) && isset($data->City) && isset($data->Area) && isset($data->Street)) {
    $email = $data->Email;
    $phone = $data->Phone;
    $city = $data->City;
    $area = $data->Area;
    $street = $data->Street;

    $query = "UPDATE userregistartion SET Phone='$phone', City='$city', Area='$area', Street='$street' WHERE Email='$email'";
    $process_query = mysqli_query($conn, $query);

    if ($process_query) {
        echo json_encode(["success" => true, "message" => "Profile updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Update failed: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No data received."]);
}
?>