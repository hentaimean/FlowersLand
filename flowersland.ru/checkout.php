<?php
	session_start();
	
	require_once "./functions/database_functions.php";
	require "./template/header.php";
	$title = "Проверка заказа";
	
	if(!isset($_SESSION['user'])){
		echo '<div class="alert alert-danger" role="alert">Вам необходимо <a href="signin.php">войти</a>, чтобы совершать покупки!</div>';
	}
	
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>	
		<table class="table">
			<tr>
				<th>Название товара</th>
				<th>Цена за шт.</th>
			    	<th>Количество</th>
			    	<th>Итоговая цена</th>
			</tr>

		    	<?php foreach($_SESSION['cart'] as $num => $qty){
				$conn = db_connect();
				$flower = mysqli_fetch_assoc(getflowerBynum($conn, $num));
				?>
			
				<tr>
					<td><?php echo $flower['flower_title']; ?></td>
					<td><?php echo $flower['flower_price'] . " руб."; ?></td>
					<td><?php echo $qty; ?></td>
					<td><?php echo $qty * $flower['flower_price'] . " руб."; ?></td>
				</tr>
			<?php } ?>
		
			<tr>
				<th><b>ИТОГО</b></th>
				<th>&nbsp;</th>
				<th><?php echo $_SESSION['total_items'];?></th>
				<th><?php echo $_SESSION['total_price'] . " руб."; ?></th>
			</tr>
		</table>
	
		<?php if(isset($_SESSION['user'])){
			echo
			'<form method="post" action="purchase.php" class="form-horizontal">
				<div class="form-group" style="margin-left:0px">
					<input type="submit" name="submit" value="Далее" class="btn btn-primary" >
					<a href="cart.php" class="btn btn-primary">Изменить</a> 
				</div>
			</form>
			<p class="lead"></p>';
		}?>
	
<?php
	}
	
	else {
		echo "<p class=\"text-warning\">Ваша корзина пуста! Добавте в нее что-нибудь!</p>";
	}
	
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
