<?php
	$id = $_GET['userid'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();
	
	$block = "true";

	$query = "UPDATE customers SET block='$block' WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не получилось заблокировать пользователя " . mysqli_error($conn);
		exit;
	}
	
	header("Location: admin_users.php");
?>
