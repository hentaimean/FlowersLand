<?php	
	if(!isset($_POST['save_change'])){
		echo "Некоторая ошибка!";
		exit;
	}

	$id = trim($_POST['id']);
	$status = trim($_POST['status']);

    require_once("./functions/database_functions.php");
	$conn = db_connect();


	$query = "UPDATE cart SET status='$status' where cartid='$id'";
	
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удалось изменить данные " . mysqli_error($conn);
		exit;
	}
	
	else {
		header("Location: admin_cart.php");
	}
?>
