<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Добавить категорию";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$name = trim($_POST['name']);
		$name = mysqli_real_escape_string($conn, $name);
		
		// найти категорию и изменить
		// если категории нет, то создать новую
		$findCat = "SELECT * FROM category WHERE category_name = '$name'";
		$findResult = mysqli_query($conn, $findCat);
		if(mysqli_num_rows($findResult)==0){
			$insertCat = "INSERT INTO category(category_name) VALUES ('$name')";
			$insertResult = mysqli_query($conn, $insertCat);
			if(!$insertResult){
				echo "Не получилось добавить новую категорию " . mysqli_error($conn);
				exit;
			}
			header("Location: admin_categories.php");
		}
		
		else {
		       echo '<p style="color:red;">Такая категория уже существует!</p>';
		}
	}
?>

	<form method="post" action="admin_addcategory.php" enctype="multipart/form-data">
		<table class="table">
			
			<th>Название категории</th>
			
			<tr>				
				<td><input class="form-control form-control-reg" type="text" name="name"></td>
			</tr>
		</table>
		
		<input type="submit" name="add" value="Добавить новую категорию" class="btn btn-primary">
		<a href="admin_categories.php" class="btn btn-default">Отменить</a> 
	</form>
	<br/>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
