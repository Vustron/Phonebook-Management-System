<?php
	include "config.php";
	try{
		$msg = $id = $error = "";
		$valid = true;

		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];
		}else{
			$valid = false;
			$error .= "Contact ID is invalid";
			$id = "";
		}

		if($valid){
		$sql = mysqli_query($conn, "DELETE contacts WHERE id = '$id'");

		$msg = array("valid"=>true, "msg"=>"Contact updated.");
		echo json_encode($msg);
	}else{
		$msg = array("valid"=>false, "msg"=>$error);
		echo json_encode($msg);
	}
	}catch (Exception $e){
		$msg =  array("valid"=>true, "msg"=>'Error-> '. $e->getMessage(). '\n');
		echo json_encode($msg);
	}
?>