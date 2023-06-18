<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		header("Location:index.php");
	}
	
	$title = "Список категорий";
	require_once "./template/header.php";
	require_once "./functions/database_functions.php";
	$conn = db_connect();
	$result = getAllCategories($conn);
?>

	<div>
	        <a href="admin_signout.php" class="btn btn-primary"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Выйти</a>
	        <a href="admin_flower.php" class="btn btn-primary"><span class="glyphicon glyphicon-asterisk"></span>&nbsp;Букеты</a>
		<a href="admin_users.php" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>&nbsp;Пользователи</a>
		<a href="admin_cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Заказы</a>
                
	</div>
	
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ID категории</th>
			<th>Название категории</th>
			<th>Изменить</th>
			<th>Удалить</th>
		</tr>
		
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		
		        <tr>
		        	<td><?php echo $row['categoryid']; ?></td>
			        <td><?php echo $row['category_name']; ?></td>
			        <?php
				        if($_SESSION['admin']==true){
					        echo '<td><a href="admin_editcategories.php?catid=';
					        echo $row['categoryid'];
					        echo'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
					        echo '<td><a href="admin_deletecategories.php?catid=';
					        echo $row['categoryid'];
					        echo '"><span class="glyphicon glyphicon-trash"></span></a></td>';
				        }
			        ?>
		        </tr>
		
		<?php } ?>
	</table>
	
	<?php
                if ($_SESSION['admin']==true){
                        echo '<a class="btn btn-primary" href="admin_addcategory.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;Добавить категорию</a>';
	        }
                ?>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
