<?php
	include "config.php";

try {
	$msg = $F_name = $L_name = $phone_number = $c_address = $id = $error = "";
	$valid = true;

	$fields = array(
		"id" => "PR ID",
		"F_name" => "F_name",
		"L_name" => "L_name",
		"phone_number" => "Phone Number",
		"c_address" => "Address"
	);

	foreach ($fields as $key => $value) {
		if (isset($_POST[$key]) && !empty($_POST[$key])) {
			$$key = mysqli_real_escape_string($conn, $_POST[$key]);
		} else {
			$valid = false;
			$error .= $value . " is invalid. ";
			$$key = "";
		}
	}

	// check for duplicates in F_name and phone_number
	$F_name_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM contacts WHERE F_name='$F_name' AND id!='$id'"))[0];
	$phone_number_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM contacts WHERE phone_number='$phone_number' AND id!='$id'"))[0];

	if ($F_name_count > 0) {
		$valid = false;
		$error .= "Duplicate first name. ";
	}

	if ($phone_number_count > 0) {
		$valid = false;
		$error .= "Duplicate phone number. ";
	}

	if ($valid) {
		$stmt = mysqli_prepare($conn, "UPDATE FROM contacts SET F_name=?, L_name=?, phone_number=?, c_address=? WHERE id=?");
		mysqli_stmt_bind_param($stmt, 'ssssi', $F_name, $L_name, $phone_number, $c_address, $id);
		mysqli_stmt_execute($stmt);

		if (mysqli_affected_rows($conn) > 0) {
			$msg = array("valid" => true, "msg" => "Contact updated.");
			echo json_encode($msg);
		} else {
			$msg = array("valid" => false, "msg" => "No changes made to the contact.");
			echo json_encode($msg);
		}
	} else {
		$msg = array("valid" => false, "msg" => $error);
		echo json_encode($msg);
	}
} catch (Exception $e) {
	$msg = array("valid" => true, "msg" => "Error-> " . $e->getMessage() . "\n");
	echo json_encode($msg);
}

?>