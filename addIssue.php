<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include("connection.php");

$rawData = file_get_contents("php://input");
$data = json_decode($rawData);

if (
    isset($data->title) &&
    isset($data->id) &&
    isset($data->category) &&
    isset($data->location) &&
    isset($data->priority) &&
    isset($data->issueDate) &&
    isset($data->residentEmail) &&
    isset($data->description)
) {

    $title = $data->title;
    $id = $data->id;
    $category = $data->category;
    $location = $data->location;
    $priority = $data->priority;
    $issueDate = $data->issueDate;
    $residentEmail = $data->residentEmail;
    $phone = isset($data->phone) ? $data->phone : "";
    $description = $data->description;

    $query = "INSERT INTO issues (id, title, category, location, priority, issueDate, residentEmail, phone, description) 
              VALUES ('$id', '$title', '$category', '$location', '$priority', '$issueDate', '$residentEmail', '$phone', '$description')";

    $process_query = mysqli_query($conn, $query);

    if ($process_query) {
        $newId = $id;
        echo json_encode([
            "success" => true,
            "message" => "Issue reported successfully.",
            "id" => $newId
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Insert failed: " . mysqli_error($conn)
        ]);
    }

} else {
    echo json_encode([
        "success" => false,
        "message" => "Missing required fields."
    ]);
}
?>