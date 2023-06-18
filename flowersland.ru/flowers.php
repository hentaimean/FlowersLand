<?php
  	session_start();
  	$count = 0;
  	require_once "./functions/database_functions.php";
  	$conn = db_connect();
  	
  	if(isset($_POST['title'])){
    		if(isset($_POST['asc'])){
      			$query = "SELECT * FROM flowers order by flower_title asc";

    		}
    		
    		else if(isset($_POST['desc'])){
      			$query = "SELECT * FROM flowers order by flower_title desc";
    		}
    		
    		else{
      			$query = "SELECT * FROM flowers";
    		}
    		
    	}
    	
    	else if(isset($_POST['price'])){
    		if(isset($_POST['asc'])){
      			$query = "SELECT * FROM flowers order by flower_price asc";
    		}
    		
    		else if(isset($_POST['desc'])){
      			$query = "SELECT * FROM flowers order by flower_price desc";
    		}
    		
    		else{
      			$query = "SELECT * FROM flowers";
    		}
  	}
  	
  	else{
    		$query = "SELECT * FROM flowers";
  	}

  	$result = mysqli_query($conn, $query);
  	$title = "Полная коллекция букетов";
  	require "./template/header.php";
?>

  	<p class="lead text-center text-muted">Полная колекция мыльных букетов</p>
	<h5 class="lead text-muted">Соритровать по:</h5>

	<form method="post" action="flowers.php">
  		<div class="radio">
    			<label><input type="radio" name="asc" >Возрастанию</label>
  		</div>
  		
  		<div class="radio">
    			<label><input type="radio" name="desc">Убыванию</label>
  		</div>
	
  		<button type="submit" class="btn" name="title">Алфавит</button>
  		<button type="submit" class="btn" name="price">Цена</button>
	</form>

	<form method="post" action="flowers.php">
		<p></p>
  		<button type="submit" class="btn btn-primary" name="clear">Сбросить</button>
	</form>

	<br><br>

    	<?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
      		<div class="row">
        		<?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          			<div class="col-md-3">
            				<a href="flower.php?flowernum=<?php echo $query_row['flower_num']; ?>">
              					<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['flower_image']; ?>">
              				</a>
              			
              				<table>
               	 			<tr>
               	   				<td><strong>  <?php echo $query_row['flower_title']; ?></strong></td>
               	 			</tr>
                			
               	 			<tr>
               	 				<td><strong><?php echo $query_row['flower_price'];?> руб.</strong>  </td>
               	 			</tr>
              				</table>
            			</div>
        			
        			<?php $count++;
          		
          			if($count >= 4){
              				$count = 0;
              				break;
            			}
          		} ?> 
      		</div>
      		<br><br>
	<?php }
	
  	if(isset($conn)) { mysqli_close($conn); }
  	require_once "./template/footer.php";
?>

 	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 	
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    	
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
