<?php

	session_start();
	
	require_once "./functions/database_functions.php";
	require_once "./functions/cart_functions.php";
	$conn = db_connect();
	
	if(isset($_POST['flowernum'])){
		$flower_num = $_POST['flowernum'];
	}

	if(isset($flower_num)){
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0';
		}

		if(!isset($_SESSION['cart'][$flower_num])){
			$_SESSION['cart'][$flower_num] = 1;
		}
		
		elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$flower_num]++;
			unset($_POST);
		}
	}

	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $num =>$qty){
			if($_POST[$num] == '0'){
				unset($_SESSION['cart']["$num"]);
			}
			
			else {
				$_SESSION['cart']["$num"] = $_POST["$num"];
			}
		}
	}
	
	if(isset($_POST['clear_cart'])){
		foreach($_SESSION['cart'] as $num =>$qty){
		        $_POST[$num] == '0';
		        unset($_SESSION['cart']["$num"]);
		}
	}


	$title = "Корзина покупок";
	require "./template/header.php";

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>

   		<form action="cart.php" method="post">
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
					<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $num; ?>"></td>
					<td><?php echo $qty * $flower['flower_price'] . " руб."; ?></td>
				</tr>
				<?php } ?>
			
		    		<tr>
		    			<td><b>ИТОГО</b></td>
		    			<th>&nbsp;</th>
		    			<th><?php echo $_SESSION['total_items']; ?></th>
		    			<th><?php echo $_SESSION['total_price'] . " руб."; ?></th>
		    		</tr>
	   		</table>
	   	
		   	<button type="submit" class="btn btn-primary" name="save_change">Сохранить изменения</button>
		   	<button class="btn btn-primary" name="clear_cart">Очистить корзину</button>
	  
		</form>
		<br/><br/>
	
		<a href="checkout.php" class="btn btn-primary">Перейти к оформлению</a> 
		<a href="flowers.php" class="btn btn-primary">Вернуться к товарам</a>
	
		<?php
	}
	
	else {
		echo "<p class=\"text-warning\">Ваша корзина пуста! Добавте в нее что-нибудь!</p>";
	}
	
	if(isset($_SESSION['user'])){
		$customer=getCustomerIdbyEmail($_SESSION['email']);
		$customerid=$customer['id'];
		$query="SELECT * FROM cart join flowers join customers on customers.id='$customerid' and cart.productid=flowers.flower_num";
	 	$result=mysqli_query($conn, $query);
	 
	 	if(mysqli_num_rows($result) != 0){
	 		echo '<br><br><br><h4>Ваша история покупок</h4><table class="table">
	 		<tr>
				<th>Букет</th>
				<th>Количество</th>
				<th>Дата</th>
				<th>Общая стоимость</th>
				<th>Статус</th>
	 		</tr>';
			
			for($i = 0; $i < mysqli_num_rows($result); $i++){
				while($query_row = mysqli_fetch_assoc($result)){
					if ($query_row['id'] == $query_row['customerid']){
						echo '<tr>
							<td>
								<a href="flower.php?flowernum=' . $query_row['flower_num'] . '">';
									echo '<img style="height:150px; width:150px" class="img-responsive img-thumbnail" src="./bootstrap/img/' . $query_row['flower_image'] . '">';
								echo' </a>
							</td>
						
							<td>';
								echo $query_row['quantity'] . ' шт.';
								echo '
							</td>
					
							<td>';
								echo $query_row['date'];
								echo'
							</td>
						
							<td>';
								echo $query_row['flower_price'] * $query_row['quantity'] + 350 . ' руб.';
								echo'
							</td>
							
							<td>';
								echo $query_row['status'];
								echo'
							</td>
						</tr>';
					}
				}
			}	
		}
	} ?>
	
<?php	 
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
