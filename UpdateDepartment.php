<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");
$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if(isset($data->id) && isset($data->departmentName) && isset($data->city) && isset($data->postalCode) && isset($data->category) && isset($data->headName) && isset($data->officialPhone)) {

    $id = $data->id;
    $departmentName = $data->departmentName;
    $city = $data->city;
    $postalCode = $data->postalCode;
    $category = $data->category;
    $headName = $data->headName;
    $officialPhone = $data->officialPhone;

    $query = "UPDATE department SET departmentName='$departmentName', city='$city', postalCode='$postalCode', category='$category', headName='$headName', officialPhone='$officialPhone' WHERE id='$id'";
    $process_query = mysqli_query($conn, $query);

    if ($process_query) {
        echo json_encode(["success" => true, "message" => "Department updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Update failed: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No data received."]);
}
?>