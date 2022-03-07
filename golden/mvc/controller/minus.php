<?php 
session_start();
$id = $_GET['id'];
$temp = [];
$cart = $_SESSION['cart'];
$money = "0"."."."00";
$dolar = '$';
foreach ($cart as $value) {
	if ($id == $value->id){
		if($value->quality >= 0){
			$value->quality = $value->quality - 1;
		}
	}
	if($value->quality > 0){
	array_push($temp, $value);
	}
}
foreach ($temp as $value) {
	$money = $money + ($value->price * $value->quality);
}
$_SESSION['cart'] = $temp;
$_SESSION['total'] = $dolar.$money;
echo json_encode($_SESSION);