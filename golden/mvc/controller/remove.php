<?php 
session_start();
$id = $_GET['id'];
$temp = [];
$cart = $_SESSION['cart'];
$money = "0"."."."00";
$dolar = '$';
foreach ($cart as $value) {
	if ($id != $value->id){
		array_push($temp, $value);
	}
	}
foreach ($temp as $value) {
	$money = $money + ($value->price * $value->quality);
}
$_SESSION['cart'] = $temp;
$_SESSION['total'] = $dolar.$money;
echo json_encode($_SESSION);

