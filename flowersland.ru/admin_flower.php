<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Список букетов";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAll($conn);
?>	

	<div>
		<a href="admin_signout.php" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Выйти</a>
		<a href="admin_categories.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Категории</a>
		<a href="admin_users.php" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;Пользователи</a>
		<a href="admin_cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Заказы</a>
	
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>Номер букета</th>
			<th>Название</th>
			<th>Описание</th>
			<th>Цена</th>
			<th>Категория</th>
			<th>Изменить</th>
			<th>Удалить</th>
		</tr>
		
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td><?php echo $row['flower_num']; ?></td>
				<td><?php echo $row['flower_title']; ?></td>
				<td><?php echo $row['flower_descr']; ?></td>
				<td><?php echo $row['flower_price'] . " руб."; ?></td>
				<td><?php echo getCatName($conn, $row['categoryid']); ?></td>
			
			<?php if($_SESSION['admin']==true){
				echo '<td><a href="admin_edit.php?flowernum=';
				echo $row['flower_num'];
				echo'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
				echo '<td><a href="admin_delete.php?flowernum=';
				echo $row['flower_num']; 
				echo '"><span class="glyphicon glyphicon-trash"></span></a></td>';
			}?>

		</tr>
		<?php } ?>
	</table>
	
	<?php if ($_SESSION['admin']==true){
		echo '<a class="btn btn-primary" href="admin_add.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Добавить букет</a>';
	}?>
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
