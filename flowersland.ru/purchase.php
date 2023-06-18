<?php
	session_start();
	
	require_once "./functions/database_functions.php";

	$title = "Оформление заказа";
	require "./template/header.php";

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
		$customer = getCustomerIdbyEmail($_SESSION['email']);
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
				$flower = mysqli_fetch_assoc(getflowerBynum($conn, $num)); ?>
				
				<tr>
					<td><?php echo $flower['flower_title']; ?></td>
					<td><?php echo $flower['flower_price'] . " руб."; ?></td>
					<td><?php echo $qty; ?></td>
					<td><?php echo $qty * $flower['flower_price'] . " руб."; ?></td>
				</tr>
			<?php } ?>
			
			<tr>
				<td>Доставка</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>350 руб.</td>
			</tr>
		
			<tr>
				<th>ИТОГО</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><?php echo $_SESSION['total_price'] + 350 . " руб."; ?></th>
			</tr>
		</table>
		
		<br><br>
	
		<h4 style="margin-left:-20px">Информация о покупателе</h4>
	
		<br>
	
		<form method="post" action="process.php" class="form-horizontal">
			<div class="form-group">
        			<label for="exampleInputEmail1">Имя</label>
        			<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
    			</div>
    
    			<div class="form-group">
        			<label for="exampleInputEmail1">Фамилия</label>
        			<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
    			</div>

    			<div class="form-group">
        			<label for="inputAddress">Адрес</label>
        			<input type="text" class="form-control form-control-reg" id="inputAddress" value="<?php echo $customer['address']?>" name="address">
    			</div>
    
    			<div class="form-row">
				<div class="form-group col-md-2"></div>
        
        			<div class="form-group col-md-4">
        				<label for="inputCity">Город</label>
        				<input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $customer['city']?>">
        			</div>
        
        			<div class="form-group col-md-2"></div>
        		
        			<div class="form-group col-md-4">
        				<label for="inputZip">Индекс</label>
        				<input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $customer['zipcode']?>">
        			</div>
    			</div>
			
			<br>
    			
    			<div class="form-group col-md-12" >
        			<div class="form-group" >
            				<div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">
              					<button type="reset" class="btn">Отменить</button>
              					<button type="submit" class="btn btn-primary">Купить</button>
            				</div>
        			</div>
        		</div>
    		</form>
	
		<p class="lead"></p>
	<?php }
	
	else {
		echo "<p class=\"text-warning\">Ваша корзина пуста! Добавте в нее что-нибудь!</p>";
	}
	
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
