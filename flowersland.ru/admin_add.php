<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Добавить букет";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$num = trim($_POST['num']);
		$num = mysqli_real_escape_string($conn, $num);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);
		
		$category = trim($_POST['category']);
		$category = mysqli_real_escape_string($conn, $category);

		// добавление изображения
		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "bootstrap/img/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}
		
		// найти категорию и добавить изменения
		// если категория не найдена, то создать новую
		$findCat = "SELECT * FROM category WHERE category_name = '$category'";
		$findResult = mysqli_query($conn, $findCat);
		
		if(mysqli_num_rows($findResult)==0){
			$insertCat = "INSERT INTO category(category_name) VALUES ('$category')";
			$insertResult = mysqli_query($conn, $insertCat);
			if(!$insertResult){
				echo "Не получается добавить новую категорию " . mysqli_error($conn);
				exit;
			}	
			$categoryid = mysqli_insert_id($conn);
		}
		
		else {
			$row = mysqli_fetch_assoc($findResult);
			$category = $row['category'];
			$categoryid = mysqli_insert_id($conn);
		}

		$query = "INSERT INTO flowers VALUES ('" . $num . "', '" . $title . "', '" . $image . "',
		                                      '" . $descr . "', '" . $price . "', '" . $categoryid . "')";
		                                      
		$result = mysqli_query($conn, $query);
		
		if(!$result){
			echo "Не удалось добавить новые данные " . mysqli_error($conn);
			exit;
		}
		
		else {
			header("Location: admin_flower.php");
		}
	}
?>

	<form method="post" action="admin_add.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Номер букета</th>
				<td><input class="form-control form-control-reg" type="text" name="num"></td>
			</tr>
			
			<tr>
				<th>Название</th>
				<td><input class="form-control form-control-reg" type="text" name="title" required></td>
			</tr>
			
			<tr>
				<th>Изображение</th>
				<td><input type="file" name="image"></td>
			</tr>
			
			<tr>
				<th>Описание</th>
				<td><textarea class="form-control form-control-opis" name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			
			<tr>
				<th>Цена</th>
				<td><input class="form-control form-control-reg" type="text" name="price" required></td>
			</tr>
			
			<tr>
				<th>Категория</th>
				<td><input class="form-control form-control-reg" type="text" name="category" required></td>
			</tr>
		</table>
		
		<input type="submit" name="add" value="Добавить новый букет" class="btn btn-primary">
		<a href="admin_flower.php" class="btn btn-default">Отменить</a>
	</form>
	<br/>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
