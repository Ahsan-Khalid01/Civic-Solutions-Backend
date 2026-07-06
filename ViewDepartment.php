<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { http_response_code(200); exit(); }

include("connection.php");

$query = "SELECT * FROM department";
$process_query = mysqli_query($conn, $query);
$department = [];
if ($process_query) {
    while ($row = mysqli_fetch_assoc($process_query)) {
        $department[] = $row;
    }
}
echo json_encode($department);
?>