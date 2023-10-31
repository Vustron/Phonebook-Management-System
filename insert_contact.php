<?php

include "config.php";

try {
    $msg = "";
    $valid = true;

    $F_name = isset($_POST['F_name']) ? trim($_POST['F_name']) : "";
    $L_name = isset($_POST['L_name']) ? trim($_POST['L_name']) : "";
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : "";
    $c_address = isset($_POST['c_address']) ? trim($_POST['c_address']) : "";

    if (empty($F_name) || empty($L_name) || empty($phone_number) || empty($c_address)) {
        $valid = true;
        $msg = array("valid" => false, "msg" => "Invalid input.");
    } else {
        // Check for duplicates
        $query = "SELECT * FROM contacts WHERE F_name = '$F_name' AND L_name = '$L_name' AND phone_number = '$phone_number' AND c_address = '$c_address'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $valid = false;
            $msg = array("valid" => false, "msg" => "Duplicate contact.");
        } else {
            // Check for duplicates in phone_number
            $query = "SELECT * FROM contacts WHERE phone_number = '$phone_number'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $valid = false;
                $msg = array("valid" => false, "msg" => "Duplicate phone number");
            } else {
                // Insert new contact
                $query = "INSERT INTO contacts(F_name, L_name, phone_number, c_address) VALUES('$F_name', '$L_name', '$phone_number', '$c_address')";
                if (mysqli_query($conn, $query)) {
                    $msg = array("valid" => true, "msg" => "Contact added.");
                } else {
                    $valid = false;
                    $msg = array("valid" => false, "msg" => "Error inserting contact.");
                }
            }
        }
    }

    echo json_encode($msg);

} catch (Exception $e) {
    $msg = array("valid" => false, "msg" => "Error: " . $e->getMessage());
    echo json_encode($msg);
}

?>