<?php	
	if(!isset($_POST['save_change'])){
		echo "Некоторая ошибка!";
		exit;
	}

	$category = trim($_POST['name']);
	$id = trim($_POST['id']);

    require_once("./functions/database_functions.php");
	$conn = db_connect();


	$query = "UPDATE category SET  
	category_name = '$category' where categoryid='$id'";
	
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удалось изменить данные " . mysqli_error($conn);
		exit;
	}
	
	else {
		header("Location: admin_categories.php");
	}
?>
