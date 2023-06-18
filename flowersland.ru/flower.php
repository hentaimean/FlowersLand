<?php
	session_start();
	
	$flower_num = $_GET['flowernum'];
  	require_once "./functions/database_functions.php";
  	$conn = db_connect();

  	$query = "SELECT * FROM flowers join category on flowers.flower_num = '$flower_num' and flowers.categoryid=category.categoryid";
  	$result = mysqli_query($conn, $query);
  	
  	if(!$result){
    		echo "Не удается получить данные " . mysqli_error($conn);
    		exit;
  	}

  	$row = mysqli_fetch_assoc($result);
  	
  	if(!$row){
    		echo "Пусто!";
    		exit;
  	}

  	$title = "Букет: " . $row['flower_title'];
  	require "./template/header.php";
?>

      	<p class="lead"><a class="text-muted" href="flowers.php">Букеты</a> > <?php echo $row['flower_title']; ?></p>
      	<div class="row">
		<div class="col-md-3 text-center">
		<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['flower_image']; ?>">
		</div>
		
		<div class="col-md-6">
          		<h4>Описание</h4>
          		<p><?php echo $row['flower_descr']; ?></p>
          		<h4>Детали</h4>
          		
          		<table class="table">
          			<?php foreach($row as $key => $value){
              				if($key == "flower_descr" || $key == "flower_image" || $key == "flower_title" || $key == "categoryid"){
                				continue;
              				}
              			
              				switch($key){
                				case "flower_num":
                  					$key = "Номер букета";
                  					break;
                				case "flower_title":
                  					$key = "Название";
                  					break;
                				case "flower_price":
                  					$key = "Цена, руб.";
                  					break;
                				case "category_name":
                  					$key = "Название категории";
                  					break;
              				}?>
            				
            				<tr>
              					<td><?php echo $key; ?></td>
              					<td><?php echo $value; ?></td>
            				</tr>
            				
            			<?php }
              			
              			if(isset($conn)){
              				mysqli_close($conn);
              			}?>
          		</table>
          
          		<form method="post" action="cart.php">
            			<input type="hidden" name="flowernum" value="<?php echo $flower_num;?>">            
            			<input type="submit" value="Добавить в корзину" name="cart" class="btn btn-primary">
          		</form>
       	</div>
      	</div>

<?php require "./template/footer.php"; ?>
