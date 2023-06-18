<?php
	session_start();

	require_once "./functions/database_functions.php";
	require "./template/header.php";
	$title = "Профиль";

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
	
	$avatar = trim($_POST['avatar']);
	$avatar = mysqli_real_escape_string($conn, $avatar);
	
	$customer = getCustomerIdbyEmail($_SESSION['email']);
	$id = $customer['id'];
	
	$query = "UPDATE customers set
					firstname='$firstname', lastname='$lastname' , address='$address',
					city='$city', zipcode='$zipcode', avatar='$avatar' where id='$id'";
	
	mysqli_query($conn, $query);    
?>

	<p class="lead text-success" style="text-align:center" id="p">Ваш профиль успешно обновлен!</p>
   	
   	<script>
		window.setTimeout(function(){
			window.location.href = "profile.php";
		}, 3000);
	
   	</script>

<?php
	if(isset($conn)){mysqli_close($conn);}
	require_once "./template/footer.php";
?>
