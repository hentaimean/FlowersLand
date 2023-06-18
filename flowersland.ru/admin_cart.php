<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Список категорий";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	
	$query = "SELECT * FROM cart join flowers join customers on cart.productid = flowers.flower_num and cart.customerid=customers.id";
	$result = mysqli_query($conn, $query);
	
?>

	<div>
	        <a href="admin_signout.php" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Выйти</a>
	        <a href="admin_flower.php" class="btn btn-primary"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;Букеты</a>
		<a href="admin_users.php" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;Пользователи</a>
	        <a href="admin_categories.php" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Категории</a>
                
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ID заказа</th>
			<th>Имя Фамилия</th>
			<th>Дата</th>
			<th>Название букета</th>
			<th>Количество</th>
			<th>Общая стоимость</th>
			<th>Статус заказа</th>
			<th>Изменить</th>
			<th>Удалить</th>
		</tr>
		
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		
		        <tr>
		        	<td><?php echo $row['cartid']; ?></td>
			        <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
			        <td><?php echo $row['date']; ?></td>
			        <td><?php echo $row['flower_title']; ?></td>
			        <td><?php echo $row['quantity']; ?></td>
			        <td><?php echo $row['flower_price'] * $row['quantity'] + 350 . " руб."; ?></td>
			        <td><?php echo $row['status']; ?></td>
			        
			        <?php
				        if($_SESSION['admin']==true){
					        echo '<td><a href="admin_editstatus.php?cartid=';
					        echo $row['cartid'];
					        echo '"><span class="glyphicon glyphicon-pencil"></span></a></td>';
					        echo '<td><a href="admin_deletecart.php?cartid=';
					        echo $row['cartid'];
					        echo '"><span class="glyphicon glyphicon-trash"></span></a></td>';
				        }
			        ?>
		        </tr>
		
		<?php } ?>
	</table>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
