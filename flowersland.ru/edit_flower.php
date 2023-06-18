<?php	
	if(!isset($_POST['save_change'])){
		echo "Некоторая ошибка!";
		exit;
	}

	$num = trim($_POST['num']);
	$title = trim($_POST['title']);
	$descr = trim($_POST['descr']);
	$price = floatval(trim($_POST['price']));
	$category = trim($_POST['category']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

	require_once("./functions/database_functions.php");
	$conn = db_connect();

	$findCat = "SELECT * FROM category WHERE category_name = '$category'";
	$findResult = mysqli_query($conn, $findCat);
	
	if(mysqli_num_rows($findResult)==0){
		$insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
		$insertResult = mysqli_query($conn, $insertCat);

		if(!$insertResult){
			echo "Не удалось добавить новую категорию " . mysqli_error($conn);
			exit;
		}

		$categoryid = mysqli_insert_id($conn);

	}
	
	else {
		$row = mysqli_fetch_assoc($findResult);
		$categoryid = $row['categoryid'];
	}


	$query = "UPDATE flowers SET  
	flower_title = '$title',  
	flower_descr = '$descr', 
	flower_price = '$price',
	categoryid = '$categoryid'";
	
	if(isset($image)){
		$query .= ", flower_image='$image' WHERE flower_num = '$num'";
	}
	
	else {
		$query .= " WHERE flower_num = '$num'";
	}
	
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удалось изменить данные " . mysqli_error($conn);
		exit;
	}
	
	else {
		header("Location: admin_flower.php");
	}
?>
