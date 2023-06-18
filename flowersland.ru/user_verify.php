<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$name = trim($_POST['username']);
	$pass = trim($_POST['password']);
	$pass = md5($pass);

	if(empty($name) || empty($pass)){
		header("Location:../signin.php?signin=empty");
	}
	
	else{
		// проерка, если это администратор
		$query = "SELECT name, pass from admin";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
	
		if($name == $row['name'] && $pass == $row['pass'] ){
			$_SESSION['admin'] = true;
			unset($_SESSION['user']);
			unset($_SESSION['email']);
			header("Location: admin_flower.php");
		}
	
		else{
			// проверка, если это пользователь
			$name = mysqli_real_escape_string($conn, $name);
			$pass = mysqli_real_escape_string($conn, $pass);
			$query = "SELECT email, password, id, block from customers";
			$result = mysqli_query($conn, $query);

			for($i = 0; $i < mysqli_num_rows($result); $i++){
				$row = mysqli_fetch_assoc($result);
				if($name == $row['email'] && $pass == $row['password']){
					if($row['block'] == "false"){
						$_SESSION['user'] = true;	
						$_SESSION['email'] = $name;
						$id = $row['id'];
						unset($_SESSION['admin']);
					
						// если вход выполнен, то происходит генерация ключа куки и сохранение его в БД, где id = id профиля
						if(!empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1){
							$key = md5(random_int(-9999, 9999));
							setcookie("id", $id, strtotime("+30 days"));
							setcookie("key", $key, strtotime("+30 days"));
							$query = "UPDATE customers SET cookie='$key' WHERE id='$id'";
							mysqli_query($conn, $query);
						}
					
						header("Location: index.php");
					}
				}
			
				if(!isset($_SESSION['user'])){
					header("Location:../signin.php?signin=invaliduser");
				}
			}
		}
	}

	if(isset($conn)) {mysqli_close($conn);}
	
?>
