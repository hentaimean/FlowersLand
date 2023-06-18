<?php
	session_start();
	
	require_once "./functions/database_functions.php";
	$title = "Профиль";
	require "./template/header.php";
	
	if(isset($_SESSION['email'])){
		$customer = getCustomerIdbyEmail($_SESSION['email']);
?>
		<form method="post" action="editProfile.php" class="form-horizontal">
    			<div class="form-group">
        			<label for="exampleInputEmail1">Имя</label>
        			<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" value="<?php echo $customer['firstname']?>" name="firstname">
    			</div>
    
    			<div class="form-group">
        			<label for="exampleInputEmail1">Фамилия</label>
        			<input type="text" class="form-control form-control-reg" aria-describedby="emailHelp" value="<?php echo $customer['lastname']?>" name="lastname">
    			</div>
    			
    			<div class="form-group">
        			<label>Аватарка</label>
        			<div>
        				<img class="img-responsive img-thumbnail img-avatar" src="./bootstrap/avatar/<?php echo $customer['avatar']; ?>">
        				<input type="file" name="avatar">
        			</div>
    			</div>

    			<div class="form-group">
        			<label for="inputAddress">Адрес</label>
        			<input type="text" class="form-control form-control-reg" id="inputAddress" value="<?php echo $customer['address']?>" name="address">
    			</div>
    
    			<div class="form-row">
				<div class="form-group col-md-2"></div>
        			<div class="form-group col-md-4">
        				<label for="inputCity">Город</label>
        				<input type="text" class="form-control" id="inputCity" name="city" value="<?php echo $customer['city']?>">
        			</div>
        
        			<div class="form-group col-md-2"></div>
        			<div class="form-group col-md-4">
        				<label for="inputZip">Индекс</label>
        				<input type="text" class="form-control" id="inputZip" name="zipcode" value="<?php echo $customer['zipcode']?>">
        			</div>
    			</div>
	
			<br>
    
    			<div class="form-group col-md-12" >
        			<div class="form-group" >
            				<div class="col-lg-10 col-lg-offset-2" style="margin-left:0px">
              					<button type="reset" class="btn btn">Отмена</button>
              					<button type="submit" class="btn btn-primary">Изменить</button>
            				</div>
        			</div>
        		</div>
    		</form>

    	<?php }
    	 
	if(isset($conn)){ mysqli_close($conn); }
	require_once "./template/footer.php";
?>
