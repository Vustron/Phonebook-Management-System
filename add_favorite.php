<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $contact_id = $_POST['id'];
    $is_favorite = $_POST['favorite'];

    if ($is_favorite === 1) {
        $update_query = "UPDATE contacts SET favorite = 1 WHERE id = '$contact_id'";
    } else {
        $update_query = "UPDATE contacts SET favorite = 0 WHERE id = '$contact_id'";
    }
    
    if (mysqli_query($conn, $update_query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>