<?php
	session_start();
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Изменить профиль пользователя";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['userid'])){
		$id = $_GET['userid'];
	}
	
	else {
		echo "Пустой запрос!";
		exit;
	}

	if(!isset($id)){
		echo "Пустой номер! Попробуйте снова!";
		exit;
	}

	// получить данные пользователя
	$query = "SELECT * FROM customers WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удалось получить данные " . mysqli_error($conn);
		exit;
	}
	
	$row = mysqli_fetch_assoc($result);
?>

	<form method="post" action="edit_user.php" enctype="multipart/form-data">
		<table class="table">
       		<tr>
				<th>ID</th>
				<td><input class="form-control form-control-reg" type="text" name="id" value="<?php echo $row['id'];?>" readOnly="true"></td>
			</tr>
			
			<tr>
				<th>Имя</th>
				<td><input class="form-control form-control-reg" type="text" name="firstname" value="<?php echo $row['firstname'];?>" required></td>
			</tr>
			
			<tr>
				<th>Фамилия</th>
				<td><input class="form-control form-control-reg" type="text" name="lastname" value="<?php echo $row['lastname'];?>" required></td>
			</tr>
			
			<tr>
				<th>E-mail</th>
				<td><input class="form-control form-control-reg" type="text" name="email" value="<?php echo $row['email'];?>" readOnly="true"></td>
			</tr>
			
			<tr>
				<th>Город</th>
				<td><input class="form-control form-control-reg" type="text" name="city" value="<?php echo $row['city'];?>" required></td>
			</tr>
			
			<tr>
				<th>Адрес</th>
				<td><input class="form-control form-control-reg" type="text" name="address" value="<?php echo $row['address'];?>" required></td>
			</tr>
			
			<tr>
				<th>Индекс</th>
				<td><input class="form-control form-control-reg" type="text" name="zipcode" value="<?php echo $row['zipcode'];?>" required></td>
			</tr>			
		</table>
		
		<input type="submit" name="save_change" value="Изменить" class="btn btn-primary">
		<a href="admin_users.php" class="btn btn-default">Отменить</a>
	</form>
	<br/>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>
