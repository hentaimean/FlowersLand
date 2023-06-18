<?php
	$id = $_GET['cartid'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM cart WHERE cartid = '$id'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не получилось очистить данные " . mysqli_error($conn);
		exit;
	}
	
	header("Location: admin_cart.php");
?>
