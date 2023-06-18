<?php	
	if(!isset($_POST['save_change'])){
		echo "Некоторая ошибка!";
		exit;
	}

	require_once("./functions/database_functions.php");
	$conn = db_connect();

	$id = trim($_POST['id']);
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$city = trim($_POST['city']);
	$address = trim($_POST['address']);
	$zipcode = trim($_POST['zipcode']);
	
	$query = "UPDATE customers SET  
	firstname = '$firstname',
	lastname = '$lastname',
	city = '$city',
	address = '$address',
	zipcode = '$zipcode' WHERE id = '$id'";
	
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удалось изменить данные " . mysqli_error($conn);
		exit;
	}
	
	else {
		header("Location: admin_users.php");
	}
?>
