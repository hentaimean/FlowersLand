<?php
	$title = "Регистрация";
	require_once "./template/header.php";
?>

	<form class="form-horizontal" method="post" action="user_signup.php">
    		<div class="form-group">
        		<label for="exampleInputEmail1">Имя</label>
        		<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" placeholder="Введитея Ваше имя" name="firstname">
    		</div>
    
    		<div class="form-group">
        		<label for="exampleInputEmail1">Фамилия</label>
        		<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" placeholder="Введите Вашу фамилию" name="lastname">
    		</div>
    
    		<div class="form-group">
        		<label for="inputEmail4">E-mail</label>
        		<input type="text" class="form-control form-control-reg" id="inputEmail4" placeholder="Введите Вашу электронную почту" name="email">
        	</div>
    
    		<div class="form-group">
        		<label for="inputAddress">Адрес проживания</label>
        		<input type="text" class="form-control form-control-reg" id="inputAddress" placeholder="Введите Ваш адрес проживания" name="address">
    		</div>
    		
    		<div class="form-row">
        		<div class="form-group col-md-4">
        			<label for="inputCity">Город</label>
        			<input type="text" class="form-control" id="inputCity" placeholder="Введите Ваш город" name="city">
        		</div>
        
        		<div class="form-group col-md-2"></div>
        		
        		<div class="form-group col-md-4">
        			<label for="inputZip">Индекс</label>
        			<input type="text" class="form-control" id="inputZip" placeholder="Введите Ваш индекс" name="zipcode">
        		</div>
    		</div>
    		
    		<div class="form-row">
    			<div class="form-group col-md-4">
        			<label for="inputPassword4">Пароль</label>
        			<input type="password" class="form-control" id="inputPassword4" placeholder="Придумайте пароль" name="password">
    			</div>
    			
    			<div class="form-group col-md-2"></div>
    			
    			<div class="form-group col-md-4">
        			<label for="inputPassword4">Подтвердите пароль</label>
        			<input type="password" class="form-control" id="inputPassword4" placeholder="Введите пароль еще раз" name="checkpassword">
    			</div>
    			
    			<div class="form-group col-md-4">
        			<div class="g-recaptcha" data-sitekey="6LcFLrsdAAAAAF9wPu02vlIOJvitH3SLNl8SHrZb"></div>
    			</div>
    		</div>
    
    		<div class="form-group col-md-12">
    			<button type="submit" class="btn btn-primary">Продолжить</button>
    		</div>
	</form>

	<div style="position:absolute; top:60px">

		<?php $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    		if(strpos($fullurl,"signup=empty")==true){
        		echo '<P style="color:red">Заполните все поля, пожалуйста.</P>';
        		exit();
    		}
    
    		if(strpos($fullurl,"signup=invalidemail")==true){
        		echo '<P style="color:red">Вы ввели неверный адрес электронной почты.</P>';
        		exit();
    		}
    		
    		if(strpos($fullurl,"signup=invalidpassword")==true){
        		echo '<P style="color:red">Введенные пароли не совпадают.</P>';
        		exit();
    		}
    		
    		if(strpos($fullurl,"signup=invaliduser")==true){
        		echo '<P style="color:red">Введенный e-mail уже используется.</P>';
        		exit();
    		}
    		
    		if(strpos($fullurl,"signup=invalidrecaptcha")==true){
        		echo '<P style="color:red">Неверная reCAPTCHA. Попробуйте снова.</P>';
        		exit();
    		}
    		
    		if(strpos($fullurl,"signup=invalidpwd")==true){
        		echo '<P style="color:red">Пароль должен содержать не менее 8 символов и включать как минимум одну цифру и одну букву.</P>';
        		exit();
    		} ?>
	</div>

<?php
	require_once "./template/footer.php";
?>
