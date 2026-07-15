<?php
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    // header("Access-Control-Allow-Headers: Content-Type");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
         {
        http_response_code(200);
        exit();
        }
   
    include("connection.php");

    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData);

    if(isset($data->fullname) && isset($data->cnic) && isset($data->dob) && isset($data->gender) && isset($data->phone) && isset($data->email)  && isset($data->city) && isset($data->area) && isset($data->address) && isset($data->postalCode) && isset($data->password) && isset($data->confirmPassword)) {
        
    $name=$data->fullname;
    $cnic=$data->cnic;
    $dob=$data->dob;
    $gender=$data->gender;
    $phone=$data->phone;
    $email=$data->email;  
    $city=$data->city;
    $area=$data->area;
    $address=$data->address;
    $postalCode=$data->postalCode;
    $password=$data->password;
    $confirmPassword=$data->confirmPassword;


        $query = "INSERT INTO userregistartion (FullName, CNIC, DOB, Gender, Phone, Email, City, Area,Street , PostalCode, Password , ConfirmedPassword) VALUES ('$name', '$cnic', '$dob', '$gender', '$phone', '$email', '$city', '$area', '$address', '$postalCode', '$password', '$confirmedPassword')";

       $query = "INSERT INTO userregistartion (FullName, CNIC, DOB, Gender, Phone, Email, City, Area,Street , PostalCode, Password , ConfirmedPassword) VALUES ('$name', '$cnic', '$dob', '$gender', '$phone', '$email', '$city', '$area', '$address', '$postalCode', '$password', '$confirmPassword')";

        $process_query = mysqli_query($conn, $query);

        if ($process_query) {
            echo json_encode([
                "success" => true, 
                "message" => "Successfully inserted record for $name."
            ]);
        } else {
            echo json_encode([
                "success" => false, 
                "message" => "Try again. Database insertion failed: " . mysqli_error($conn)
            ]);
        }
        
    } else {
        echo json_encode([
            "success" => false, 
            "message" => "No data was received by the server."
        ]);
    }
