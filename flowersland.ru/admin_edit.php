<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Изменить букет";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['flowernum'])){
		$flower_num = $_GET['flowernum'];
	}
	
	else {
		echo "Пустой запрос!";
		exit;
	}

	if(!isset($flower_num)){
		echo "Пустой номер! Попробуйте снова!";
		exit;
	}

	// получить данные о букете
	$query = "SELECT * FROM flowers WHERE flower_num = '$flower_num'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Не удалось получить данные " . mysqli_error($conn);
		exit;
	}
	
	$row = mysqli_fetch_assoc($result);
?>

	<form method="post" action="edit_flower.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Номер букета</th>
				<td><input class="form-control form-control-reg" type="text" name="num" value="<?php echo $row['flower_num'];?>" readOnly="true"></td>
			</tr>
			
			<tr>
				<th>Название</th>
				<td><input class="form-control form-control-reg" type="text" name="title" value="<?php echo $row['flower_title'];?>" required></td>
			</tr>
			
			<tr>
				<th>Изображение</th>
				<td><input type="file" name="image"></td>
			</tr>
			
			<tr>
				<th>Описание</th>
				<td><textarea class="form-control form-control-opis" name="descr" cols="40" rows="5"><?php echo $row['flower_descr'];?></textarea>
			</tr>
			
			<tr>
				<th>Цена</th>
				<td><input class="form-control form-control-reg" type="text" name="price" value="<?php echo $row['flower_price'];?>" required></td>
			</tr>
			
			<tr>
				<th>Категория</th>
				<td><input class="form-control form-control-reg" type="text" name="category" value="<?php echo getCatName($conn, $row['categoryid']); ?>" required></td>
			</tr>
		</table>
		
		<input type="submit" name="save_change" value="Изменить" class="btn btn-primary">
		<a href="admin_flower.php" class="btn btn-default">Отменить</a>
	</form>
	<br/>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>
