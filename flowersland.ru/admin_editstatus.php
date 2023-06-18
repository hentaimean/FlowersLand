<?php
	session_start();
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Изменить статус заказа";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_GET['cartid'])){
		$id = $_GET['cartid'];
	}
	
	else {
		echo "Пустой запрос!";
		exit;
	}

	if(!isset($id)){
		echo "Пустой номер! Попробуйте снова!";
		exit;
	}

	// получить данные заказа
	$query = "SELECT * FROM cart WHERE cartid = '$id'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удалось получить данные " . mysqli_error($conn);
		exit;
	}
	
	$row = mysqli_fetch_assoc($result);
?>

	<form method="post" action="edit_cartstatus.php" enctype="multipart/form-data">
		<table class="table">
       		<tr>
       			<th>ID заказа</th>
				<td><input class="form-control form-control-reg" type="text" name="id" value="<?php echo $row['cartid'];?>" readOnly="true"></td>	
			</tr>
			
			<tr>
       			<th>Статус</th>
				<td><input class="form-control form-control-reg" type="text" name="status" value="<?php echo $row['status'];?>"></td>	
			</tr>
		</table>
		
		<input type="submit" name="save_change" value="Изменить" class="btn btn-primary">
		<a href="admin_cart.php" class="btn btn-default">Отменить</a>
	</form>
	<br/>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require "./template/footer.php"
?>
