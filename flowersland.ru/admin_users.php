<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Список пользователей";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	
	$query = "SELECT * from customers ORDER BY id DESC";
	$result = mysqli_query($conn, $query);
?>

	<div>
	        <a href="admin_signout.php" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Выйти</a>
	        <a href="admin_flower.php" class="btn btn-primary"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;Букеты</a>
	        <a href="admin_categories.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Категории</a>
		<a href="admin_cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Заказы</a>
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ID</th>
			<th>Имя Фамилия</th>
			<th>E-mail</th>
			<th>Город</th>
			<th>Адрес</th>
			<th>Индекс</th>
			<th>Изменить</th>
			<th>Удалить</th>
			<th>Блокировка</th>
		</tr>
		
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		
		        <tr>
			        <td><?php echo $row['id']; ?></td>
			        <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
			        <td><?php echo $row['email']; ?></td>
			        <td><?php echo $row['city']; ?></td>
			        <td><?php echo $row['address']; ?></td>
			        <td><?php echo $row['zipcode']; ?></td>
			        <?php
				        if($_SESSION['admin']==true){
					        echo '<td><a href="admin_editusers.php?userid=';
					        echo $row['id'];
					        echo'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
					        echo '<td><a href="admin_deleteusers.php?userid=';
					        echo $row['id'];
					        echo '"><span class="glyphicon glyphicon-trash"></span></a></td>';
					        
					        if($row['block'] == "false"){
					        	echo '<td><a href="admin_blockusers.php?userid=';
					        	echo $row['id'];
					        	echo '"><span class="glyphicon glyphicon-ban-circle">&nbsp;Заблокировать</span></a></td>';
				        	}
				        	
				        	else{
				        		echo '<td><a href="admin_unblockusers.php?userid=';
					        	echo $row['id'];
					        	echo '"><span class="glyphicon glyphicon-ok-circle">&nbsp;Разблокировать</span></a></td>';
				        	}
				        	
				        }
			        ?>
		        </tr>
		
		<?php } ?>
	</table>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
