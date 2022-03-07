<?php 
session_start();
$id = $_GET['id'];
$cart = $_SESSION['cart']; // old cart
$temp = [];//new cart
$money = 0;
$dolar = '$';


foreach ($cart as &$value) {

	if ($id == $value->id){
		if(isset($value->quality)){
			$value->quality = ++$value->quality;
		}else{
			$value->quality = 1;
		}
		
	}
	array_push($temp, $value);
}
foreach ($temp as $value) {
	$money = $money + ($value->price * $value->quality);
}
$_SESSION['cart'] = $temp;
$_SESSION['total'] =  $dolar.$money;
echo json_encode($_SESSION);
