<?php
	session_start();
	require_once "./functions/database_functions.php";
	
	if(isset($_GET['catid'])){
		$catid = $_GET['catid'];
	}
	
	else {
		echo "Неверный запрос! Попробуйте снова!";
		exit;
	}

	$conn = db_connect();
	$catName = getCatName($conn, $catid);

	$query = "SELECT flower_num, flower_title, flower_price, flower_image FROM flowers WHERE categoryid = '$catid'";
	$result = mysqli_query($conn, $query);
	
	if(!$result){
		echo "Не удается получить данные " . mysqli_error($conn);
		exit;
	}
	
	if(mysqli_num_rows($result) == 0){
		echo "Пусто! Подождите, пока появятся новые букеты!";
		exit;
	}

	$title = "Категория: " . $catName;;
	require "./template/header.php";
?>

	<p class="lead"><a  class="text-muted" href="category_list.php">Категории</a> > <?php echo $catName; ?></p>
	
	<?php while($row = mysqli_fetch_assoc($result)){
?>
		<div class="row">
			<div class="col-md-3">
				<img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['flower_image']; ?>">
			</div>
		
			<div class="col-md-7">
				<h4><?php echo $row['flower_title']; ?></h4>
				<h4><?php echo $row['flower_price']; ?> руб.</h4>
				<a href="flower.php?flowernum=<?php echo $row['flower_num']; ?>" class="btn btn-primary">Подробнее</a>
			</div>
		</div>
		<br>
	<?php }
	
	if(isset($conn)) { mysqli_close($conn);}
	require "./template/footer.php";
?>
