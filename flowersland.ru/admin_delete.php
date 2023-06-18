<?php
	$flower_num = $_GET['flowernum'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM flowers WHERE flower_num = '$flower_num'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не получилось очистить данные " . mysqli_error($conn);
		exit;
	}
	
	header("Location: admin_flower.php");
?>
