<?php
session_start();
$id = $_GET['id'];
$cart = $_SESSION['cart'];
$newcart = [];
$money = "0"."."."00";
$dolar = '$';
$product = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/golden/shoes.json');
$product = json_decode($product);
$check = false;
foreach ($product->shoes as $value) {
	if($id == $value->id){

		if(!empty($cart)){
			foreach($cart as $cartitem) { // kiem tra san pham da co trong cart hay chua neu co thi + quality
				if ($id == $cartitem->id) {
					//$cartitem->quality = $cartitem->quality + 1;
					$check = true;
				}
				array_push($newcart, $cartitem); //chuyên all san pham cart cu sang cart moi
			}
		}

		if (!$check) {
			$value->quality = 1;
			array_push($newcart, $value);
		}
	}
}

foreach ($newcart as $value) {
	$money = $money + ($value->price * $value->quality);
}
$_SESSION['cart'] = $newcart;
$_SESSION['total'] = $dolar.$money;
echo json_encode($_SESSION);