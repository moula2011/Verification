<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
</head>

<body>
	<?php
	error_reporting(E_ERROR | E_PARSE);
	session_start();
	if (!$_SESSION['valid_user']) {
		header("Location: login.php");
		exit;
	}
	include('../../../link.php');
	//==============Mustapha====================
	require('consult.class.php');

	$cashFile ='../../data/rugarama.json';
	$data_veri = array(); 

	$id = $_REQUEST['id'];
	$qtty = $_REQUEST['qtty'];
	$up = $_REQUEST['up'];
	$type = $_REQUEST['type'];
	$time = $_REQUEST['time'];
	$date = $_REQUEST['date'];	
	$item = $_REQUEST['item'];
	$amountde = $_REQUEST['amountde'];
	$comment = $_REQUEST['comment'];

	// echo $qtty."--".$up."--".$type."--".$item."--".$time."--".$amountde."--".$date;
	//===============Mustapha====================
	
	//=================================================
	// Mustapha code ibifasha JSON :
	//=================================================
	if(file_exists($cashFile))
	{
		// $date = date('Y-m-d', strtotime($date));
		$consult = new Consult('../../data/rugarama.json');

		$data_veri=[["item_veri_type"=>$type,"item_u_p"=>$up,"item_quantity"=>$qtty,"item"=>$item,"date"=>$date,"time"=>$time,"amounted"=>$amountde,"comment"=>$comment]];

		$consult->updateVerif($id,'items',$type,$data_veri,$item);
	}
	//=========================================
	// Mustapha code bigarukiraha
	//=========================================
	?>
</body>

</html>