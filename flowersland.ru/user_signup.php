<?php
	session_start();
	$title = "Регистрация";
	require "./template/header.php";
	require "./functions/database_functions.php";
	$conn = db_connect();

	$firstname = trim($_POST['firstname']);
	$firstname = mysqli_real_escape_string($conn, $firstname);
		
	$lastname = trim($_POST['lastname']);
	$lastname = mysqli_real_escape_string($conn, $lastname);

	$email = trim($_POST['email']);
	$email = mysqli_real_escape_string($conn, $email);
		
	$password = trim($_POST['password']);
	$checkpassword = trim($_POST['checkpassword']);
	$password = mysqli_real_escape_string($conn, $password);
		
	$address = trim(trim($_POST['address']));
	$address = mysqli_real_escape_string($conn, $address);
		
	$city = trim($_POST['city']);
        $city = mysqli_real_escape_string($conn, $city);
        
	$zipcode = trim($_POST['zipcode']);
	$zipcode = mysqli_real_escape_string($conn, $zipcode);

	if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($checkpassword) || empty($address) ||empty($city) || empty($zipcode)){
		header("Location:../signup.php?signup=empty");
	}
	
	else if(!trim($_POST['g-recaptcha-response'])){
		header("Location:../signup.php?signup=invalidrecaptcha");
	}
	
	else{		
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				header("Location:../signup.php?signup=invalidemail");
		}
		
		else if($password != $checkpassword){
			header("Location:../signup.php?signup=invalidpassword");
		}
		
		else if(strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)){
			header("Location:../signup.php?signup=invalidpwd");
		}
		
		else{
			$findUser = "SELECT * FROM customers WHERE email = '$email'";
			$findResult = mysqli_query($conn, $findUser);
			$password = md5($password);
		
			if(mysqli_num_rows($findResult) == 0){
				$insertUser = "INSERT INTO customers(firstname, lastname, email, address, password, city, zipcode) VALUES 
						('$firstname','$lastname','$email','$address','$password','$city','$zipcode')";
				$insertResult = mysqli_query($conn, $insertUser);
			
				if(!$insertResult){
					echo "Не удалось добавить нового пользователя " . mysqli_error($conn);
					exit;
				}
				
				$userid = mysqli_insert_id($conn);
				
				$key = md5(random_int(-9999, 9999));
				setcookie("id", $userid, strtotime("+30 days"));
				setcookie("key", $key, strtotime("+30 days"));
				$query = "UPDATE customers SET cookie='$key' WHERE id='$userid'";
				mysqli_query($conn, $query);
				
				header("Location: signin.php");
				
			}
				
			else{
				$row = mysqli_fetch_assoc($findResult);
				$userid = $row['id'];
				header("Location:../signup.php?signup=invaliduser");
			}
		}
	} ?>
	
<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>
