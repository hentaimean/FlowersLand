<?php
	$catid = $_GET['catid'];

	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "DELETE FROM category WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не получилось очистить данные " . mysqli_error($conn);
		exit;
	}
	
	header("Location: admin_categories.php");
?>
