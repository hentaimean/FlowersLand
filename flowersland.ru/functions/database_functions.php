<?php
	if (!function_exists("db_connect")){
		function db_connect(){
			$conn = mysqli_connect("localhost", "root", "", "flowershop");
			
			if(!$conn){
				echo "Не удается подключиться к " . mysqli_connect_error($conn);
				exit;
			}
			
			return $conn;
		}
	}
	
	if (!function_exists("select4Latestflower")){
		function select4Latestflower($conn){
			$row = array();
			$query = "SELECT flower_num, flower_image FROM flowers ORDER BY flower_num DESC";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
			    echo "Не удается получить данные " . mysqli_error($conn);
			    exit;
			}
			
			for($i = 0; $i < 4; $i++){
				array_push($row, mysqli_fetch_assoc($result));
			}
		
			return $row;
		}
	}

	if (!function_exists("getflowerBynum")){
		function getflowerBynum($conn, $num){
			$query = "SELECT flower_title, flower_price FROM flowers WHERE flower_num = '$num'";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
		
			return $result;
		}
	}

	if (!function_exists("getCartId")){
		function getCartId($conn, $customerid){
			$query = "SELECT id FROM cart WHERE customerid = '$customerid'";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
			
			$row = mysqli_fetch_assoc($result);
			return $row['id'];
		}
	}

	if (!function_exists("insertIntoCart")){
		function insertIntoCart($conn, $customerid, $date, $num, $qty){
			$query = "INSERT INTO cart(customerid, date, productid, quantity) VALUES('$customerid', '$date', '$num', '$qty')";
			$result = mysqli_query($conn, $query);
			
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
		}
	}

	if (!function_exists("getflowerprice")){
		function getflowerprice($num){
			$conn = db_connect();
			$query = "SELECT flower_price FROM flowers WHERE flower_num = '$num'";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
		
			$row = mysqli_fetch_assoc($result);
			return $row['flower_price'];
		}
	}

	if (!function_exists("getCustomerId")){
		function getCustomerId($name, $address, $city, $zip_code, $country){
			$conn = db_connect();
			$query = "SELECT customerid from customers WHERE name = '$name' AND address= '$address' AND
				city = '$city' AND zip_code = '$zip_code' AND country = '$country'";
			$result = mysqli_query($conn, $query);
			
			if($result){
				$row = mysqli_fetch_assoc($result);
				return $row['customerid'];
			}
			
			else {
				return null;
			}
		}
	}
	
	if (!function_exists("getCustomerIdbyEmail")){
		function getCustomerIdbyEmail($email){
			$conn = db_connect();
			$query = "SELECT * from customers WHERE email = '$email'";
			$result = mysqli_query($conn, $query);
		
			if($result){
				$row = mysqli_fetch_assoc($result);
				return $row;
			}
			
			else{
				return null;
			}
		}
	}

	if (!function_exists("getCatName")){
		function getCatName($conn, $catid){
			$query = "SELECT category_name FROM category WHERE categoryid = '$catid'";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
			
			if(mysqli_num_rows($result) == 0){
				echo "Не задано";
			}

			$row = mysqli_fetch_assoc($result);
			return $row['category_name'];
		}
	}
	
	if (!function_exists("getAll")){
		function getAll($conn){
			$query = "SELECT * from flowers ORDER BY flower_num DESC";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
			
			return $result;
		}
	}
	
	if (!function_exists("getAllCategories")){
		function getAllCategories($conn){
			$query = "SELECT * from category ORDER BY category_name ASC";
			$result = mysqli_query($conn, $query);
		
			if(!$result){
				echo "Не удается получить данные " . mysqli_error($conn);
				exit;
			}
		
			return $result;
		}
	} 
?>
