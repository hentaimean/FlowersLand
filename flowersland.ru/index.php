<?php
  	session_start();
  
  	$title = "FlowersLand";
  	require_once "./template/header.php";
  	require_once "./functions/database_functions.php";
  	$conn = db_connect();
  	$row = select4Latestflower($conn);

?> 
     	<br/><br/>
      	
      	<p class = "lead text-center text-muted">НАИБОЛЕЕ ПОПУЛЯРНЫЕ БУКЕТЫ</p>
      	
      	<br><br>
      	
      	<div class = "row">
        	<?php foreach($row as $flower) { ?>
      			<div class = "col-md-3">
      				<a href = "flower.php?flowernum=<?php echo $flower['flower_num']; ?>">
           				<img class = "img-responsive img-thumbnail" src = "./bootstrap/img/<?php echo $flower['flower_image']; ?>">
          			</a>
      			</div>
        	<?php } ?>
      	</div>
		
<?php
  	if(isset($conn)) {mysqli_close($conn);}
  	require_once "./template/footer.php";
?>
