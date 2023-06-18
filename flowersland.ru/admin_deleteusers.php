<?php
	$id = $_GET['userid'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM customers WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не получилось очистить данные " . mysqli_error($conn);
		exit;
	}
	
	header("Location: admin_users.php");
?>
