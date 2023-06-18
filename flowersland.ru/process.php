<?php
	session_start();

	require_once "./functions/database_functions.php";
	$title = "Обработка покупки";
	require "./template/header.php";
	$conn = db_connect();

	$firstname = trim($_POST['firstname']);
	$firstname = mysqli_real_escape_string($conn, $firstname);
		
	$lastname = trim($_POST['lastname']);
	$lastname = mysqli_real_escape_string($conn, $lastname);
	
	$address = trim(trim($_POST['address']));
	$address = mysqli_real_escape_string($conn, $address);
		
	$city = trim($_POST['city']);
        $city = mysqli_real_escape_string($conn, $city);
        
	$zipcode = trim($_POST['zipcode']);
	$zipcode = mysqli_real_escape_string($conn, $zipcode);

	// поиск пользователя
	$customer = getCustomerIdbyEmail($_SESSION['email']);
	$id=$customer['id'];
	$query="UPDATE customers set 
		firstname='$firstname', lastname='$lastname', address='$address',
		city='$city', zipcode='$zipcode'  where id='$id'";
	
	mysqli_query($conn, $query);
	$date = date("Y-m-d H:i:s");
	
	foreach($_SESSION['cart'] as $num => $qty){
		insertIntoCart($conn, $customer['id'], $date, $num, $qty);
	}

	unset($_SESSION['total_price']);
	unset($_SESSION['cart']);
	unset($_SESSION['total_items']);

?>
	<p class="lead text-success" style="text-align:center" id="p">Ваш заказ был успешно обработан.</p>
   	
   	<script>
		window.setTimeout(function(){
			window.location.href = "cart.php";
		}, 3000);
	
   	</script>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
