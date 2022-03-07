<?php 
session_start();
if(empty($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}
if(empty($_SESSION['total'])){
	$_SESSION['total'] = array();
}