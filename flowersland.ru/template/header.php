<?php
    	if(!isset($_SESSION)){ 
        	session_start(); 
    	}
    
    	require_once "./functions/database_functions.php";
    	
    	if(isset($_SESSION['email'])){
      		$customer = getCustomerIdbyEmail($_SESSION['email']);
      		$name = $customer['firstname'];
    	}
?>

<!DOCTYPE html>

<html lang="ru">
	<head>
    		<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">

    		<title><?php echo $title; ?></title>
			
			<link href="./bootstrap/icon.ico" rel="icon" type="image/x-icon">
			<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    		<link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    		<link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
    		
    		<script src="https://www.google.com/recaptcha/api.js"></script>
    
  	</head>

  	<body>
    		<nav class="navbar navbar-inverse navbar-fixed-top">
      			<div class="container">
        			<div class="navbar-header" >
          				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            					<span class="sr-only">Toggle navigation</span>
            					<span class="icon-bar"></span>
            					<span class="icon-bar"></span>
            					<span class="icon-bar"></span>
          				</button>

          				<div style="width: 400px; " >
          					<div class="row">
            						<a class="navbar-brand" href="http://flowersland.ru" col-md-3><b>FlowersLand</b></a>
            						<form  method="post" action="search_flower.php" class="col-md-6" style="margin-top:7px">
              							<input type="text" class="form-control" id="inputPassword2" placeholder="Поиск букета" name="text">
              							<button type="submit" class="btn btn-primary mb-2" style="display:none"></button>
           						</form>
          					</div>
          				</div>
        			</div>

        			<div id="navbar" class="navbar-collapse collapse">
          				<ul class="nav navbar-nav navbar-right">
              					<li><a href="category_list.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Категории</a></li>
              					<li><a href="flowers.php"><span class="glyphicon glyphicon-asterisk"></span>&nbsp; Букеты</a></li>
              					<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; Корзина</a></li>
              					<?php if(isset($_SESSION['user'])){
                 					echo '<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;'.$name.'</a></li>'.' <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Выйти</a></li>';
               				}
               			
               				else{
                					echo ' <li><a href="signin.php"><span class="	glyphicon glyphicon-log-in"></span>&nbsp; Войти</a></li>'.'<li><a href="signup.php"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Регистрация</a></li>';
               				} ?>
            				</ul>
        			</div>
      			</div>
    		</nav>
    
    		<?php if(isset($title) && $title == "FlowersLand") { ?>
    			<div class="jumbotron" style="  background: url('https://images.wallpaperscraft.ru/image/single/tsvety_raznotsvetnyj_buket_118856_4800x3840.jpg?-	auto=compress&cs=tinysrgb&dpr=2&h=650&w=940') no-repeat center center;background-size: cover;height:400px;">
      				<div class="container">
        				<h1 style="text-align:center; margin:5% auto; color:white;">FlowersLand — мир мыльных цветов</h1>   
        				<p style="text-align:center; margin:5% auto; color:white;">Большой выбор мыльных букетов по доступным ценам</p>     
      				</div>
    			</div>
    		<?php } ?>

    		<div class="container" id="main">
