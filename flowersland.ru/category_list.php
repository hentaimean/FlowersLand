<?php
	session_start();
	
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM category ORDER BY category_name";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удается получить данные из" . mysqli_error($conn);
		exit;
	}
	
	if(mysqli_num_rows($result) == 0){
		echo "Пустая категория! Что-то не так! Попробуйте еще раз";
		exit;
	}

	$title = "Список категорий";
	require "./template/header.php";
?>
	<p class="lead text-muted">Список категорий</p>
	
	<ul>
		<?php 
			while($row = mysqli_fetch_assoc($result)){
				$count = 0; 
				$query = "SELECT categoryid FROM flowers";
				$result2 = mysqli_query($conn, $query);
			
				if(!$result2){
					echo "Не удается получить данные из " . mysqli_error($conn);
					exit;
				}
			
				while ($pubInflower = mysqli_fetch_assoc($result2)){
					if($pubInflower['categoryid'] == $row['categoryid']){
						$count++;
					}
				}?>
			<li>
				<span class="badge"><?php echo $count; ?></span>
				<a href="flowerPerCat.php?catid=<?php echo $row['categoryid']; ?>" class="lead text-muted"><?php echo $row['category_name']; ?></a>
			</li>
		
			<?php } ?>
	</ul>

<?php
	mysqli_close($conn);
	require "./template/footer.php";
?>
