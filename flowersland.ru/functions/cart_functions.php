<?php
	function total_price($cart){
		$price = 0;
		if(is_array($cart)){
		  	foreach($cart as $num => $qty){
		  		$flowerprice = getflowerprice($num);
		  		if($flowerprice){
		  			$price += $flowerprice * $qty;
		  		}
		  	}
		}
		
		return $price;
	}

	function total_items($cart){
		$items = 0;
		if(is_array($cart)){
			foreach($cart as $num => $qty){
				$items += $qty;
			}
		}
		
		return $items;
	} ?>
