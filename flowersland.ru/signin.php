<?php
	$title = "Вход";
	require_once "./template/header.php";
	$conn = db_connect();
	
	// если есть сохраненные куки, то выполняется подстановка ключа и id, и выполняется вход 
	if(!empty($_COOKIE['id']) and !empty($_COOKIE['key'])){
			$id = $_COOKIE['id']; 
			$key = $_COOKIE['key'];
			$query = "SELECT * FROM customers WHERE id='$id' AND cookie='$key'";

			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);

			// если сохраненный в куки ключ совпадает с ключем из БД, то выполняется вход и генерация нового ключа для куки
			if(!empty($row)){
				session_start(); 
				$_SESSION['user'] = true; 
				$_SESSION['email'] = $row['email'];
				
				$key = md5(random_int(-9999, 9999));
				setcookie("id", $id, strtotime("+30 days"));
				setcookie("key", $key, strtotime("+30 days"));
				$query = "UPDATE customers SET cookie='$key' WHERE id='$id'";
				mysqli_query($conn, $query);
				
				header("Location: index.php");
			}
		}
?>

	<form class="form-horizontal" method="post" action="user_verify.php">
  		<div class="form-group">
    			<label for="exampleInputEmail1">E-mail</label>
    			<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" placeholder="Введите адрес электронной почты" name="username">
  		</div>
  
  		<div class="form-group">
    			<label for="exampleInputPassword1">Пароль</label>
    			<input type="password" class="form-control form-control-reg" placeholder="Введите пароль" name="password">
    			
    			<div class="checkbox">
  				<label><input type='checkbox' name='remember' value='1'>Запомнить меня</label>
  			</div>
  		</div>		
  		
  		<button type="submit" class="btn btn-primary">Войти</button>
	</form>

	<div style="position:absolute; top:40px">

		<?php $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
    		if(strpos($fullurl,"signin=empty")==true){
        		echo '<br><P style="color:red">Заполните все поля, пожалуйста.</P>';
        		exit();
    		}
    	
    		if(strpos($fullurl,"signin=invaliduser")==true){
        		echo '<br><P style="color:red">Пользователь не найден или заблокирован.</P>';
        		exit();
    		} ?>
	</div>

<?php
	require_once "./template/footer.php";
?>
