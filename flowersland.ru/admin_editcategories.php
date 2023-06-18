<?php
	session_start();
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Изменить категорию";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['catid'])){
		$catid = $_GET['catid'];
	}
	
	else {
		echo "Пустой запрос!";
		exit;
	}

	if(!isset($catid)){
		echo "Пустой номер! Попробуйте снова!";
		exit;
	}

	// получить данные букета
	$query = "SELECT * FROM category WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Не удалось получить данные " . mysqli_error($conn);
		exit;
	}
	
	$row = mysqli_fetch_assoc($result);
?>

	<form method="post" action="edit_category.php" enctype="multipart/form-data">
		<table class="table">
       	<th>Название категории</th>
			<tr>
				<td style="display:none"><input type="text" name="id" value="<?php echo $row['categoryid'];?>"></td>	
				<td><input class="form-control form-control-reg" type="text" name="name" value="<?php echo $row['category_name'];?>" required></td>
			</tr>
		</table>
		
		<input type="submit" name="save_change" value="Изменить" class="btn btn-primary">
		<a href="admin_categories.php" class="btn btn-default">Отменить</a>
	</form>
	<br/>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>
