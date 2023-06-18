<?php

  	$title = "Результаты поиска";
  	$text = trim($_POST['text']);
  	require_once "./functions/database_functions.php";
  	$conn = db_connect();
  	
  	$query = "SELECT * FROM flowers WHERE flower_title like '%$text%'";
  	
  	$result = mysqli_query($conn, $query);
  
  	if(mysqli_num_rows($result) == 0){
    		echo '<div class = "alert alert-warning" role = "alert">
    			Ничего не найдено...
    		</div>' . ' <div class="search_top" ></div>';
  	}
  	
  	else{
    		$number = mysqli_num_rows($result);    		   		
   		if($number == 1){
   			echo '<div class = "alert alert-success" role = "success"> Нашелся ' . $number . ' букет</div>' . ' <div class="search_top" ></div>';
   		}
   
   		if($number > 1 && $number < 5){
   			echo '<div class = "alert alert-success" role = "success"> Нашлось ' . $number . ' букета</div>' . ' <div class="search_top" ></div>';
   		}
   
   		if( $number > 4){
   			echo '<div class = "alert alert-success" role = "success"> Нашлось ' . $number . ' букетов</div>' . ' <div class="search_top" ></div>';
   		}
  	}

  	require_once "./template/header.php";
?>
     
  	<p class = "lead text-center text-muted">Результаты поиска</p>
    	
    	<?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      		<div class = "row">
        		<?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          			<div class = "col-md-3">
            				<a href = "flower.php?flowernum=<?php echo $query_row['flower_num']; ?>">
              					<img class = "img-responsive img-thumbnail" src = "./bootstrap/img/<?php echo $query_row['flower_image']; ?>">
            				</a>

            				<table>
                				<tr>
                  					<td><strong><?php echo $query_row['flower_title']; ?></strong></td>
                				</tr>
                
                				<tr>
                					<td><strong><?php echo $query_row['flower_price']; ?> руб.</strong></td>
                				</tr>
              				</table>
          			</div>
        		<?php } ?> 
      		</div>
	<?php }
  
  	if(isset($conn)) { mysqli_close($conn); }
  	require_once "./template/footer.php";
?>
