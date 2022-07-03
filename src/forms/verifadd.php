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
	include('../../link.php');
	//==============Mustapha====================
	require('consult.class.php');

	$cashFile ='../../data/rugarama.json';
	$data_veri = array(); 

	$id = $_REQUEST['id'];	
	$insu = $_REQUEST['insu'];
	$oid = $_REQUEST['oid'];
	$qtty = $_REQUEST['qtty'];
	$up = $_REQUEST['up'];
	$tot1 = $qtty * $up;
	$type = $_REQUEST['type'];
	$time = $_REQUEST['time'];
	$date = $_REQUEST['date'];	
	$period = date('F-Y',strtotime($date));
	$item = $_REQUEST['item'];
	$amountde = $_REQUEST['amountde'];
	$comment1 = $_REQUEST['comment'];
	$comment = $item.', '.$comment1;

	// echo $qtty."--".$up."--".$type."--".$item."--".$time."--".$amountde."--".$date;
	//===============Mustapha====================
	
	//=================================================
	// Mustapha code ibifasha JSON :
	//=================================================	
	if(file_exists($cashFile))
	{
		// $date = date('Y-m-d', strtotime($date));
		$consult = new Consult('../../data/rugarama.json');

		$data_veri=[["item_veri_type"=>$type,"item_order_id"=>$oid,"item_u_p"=>$up,"item_quantity"=>$qtty,"item"=>$item,"date"=>$date,"time"=>$time,"amounted"=>$amountde,"comment"=>$comment]];

		$consult->updateVerif($id,'items',$type,$data_veri,$item);

		if(isset($_POST['cid'])){
			$cid = $_REQUEST['cid'];
			$consult->updateDone($cid);
		}

		$verifier=$_SESSION['user_id'];
		$xy=mysqli_query($link,"UPDATE orders SET verified=1,verifier=$verifier WHERE client_id=$id AND date='$date'AND order_id = $oid");
		if(!$xy){die('Sorry, Could not Update Data on line 60 :'.mysqli_error($link));}

		////////////////////////////////////////////
		$produczx= "SELECT * FROM verification WHERE client_id=$id AND orders_id=$oid";
		$retvastx = mysqli_query($link,$produczx);
	if(! $retvastx ){   die('Could not get data1: ' . mysqli_error($link));    }  
	   if(mysqli_num_rows($retvastx)>0)   
	   {
$cxv=mysqli_query ($link,"UPDATE verification SET quantity=$qtty, unityp=$up  WHERE client_id='$id' AND orders_id='$oid'"); 
  if(!$cxv){ die('Could not Update data on line 57: ' . mysqli_error($link));    }
  /*********************************************/
  $proyducz= "SELECT * FROM verification WHERE client_id=$id AND orders_id=$oid";
  $retyvast = mysqli_query($link,$proyducz);
if(! $retyvast ) {   die('Could not get data2: ' . mysqli_error($link));    }                         
while($rowyz = mysqli_fetch_array($retyvast, MYSQLI_ASSOC)) 
	   {	
	   $unityx=$rowyz['unityp'];		
		$qtyyx=$rowyz['quantity'];
	   $toty2=$unityx*$qtyyx;
	   }
	   $dedamounty=$tot1-$toty2;				 
$cxy=mysqli_query ($link,"UPDATE verification SET amountde=$dedamounty WHERE client_id='$id' AND orders_id='$oid'"); 
if(!$cxy){ die('Could not Update data on line 71: ' . mysqli_error($link));    }	
/*********************************************/				   
	   }        
  else
  {
  /////////////////////////////////////////// 					  
  $cv=mysqli_query ($link,"INSERT INTO verification (client_id, orders_id, type, quantity, unityp, insurance_code, period,amountde,date,explanation) 
						   VALUES ('$id','$oid','$type',$qtty,$up,'$insu','$period',$amountde,'$date','$comment')"); 							    	
  if(!$cv){ die('Could not Insert data on line 79: ' . mysqli_error($link));    }
	
//   $producz= "SELECT * FROM verification WHERE client_id=$id AND orders_id=$oid";
// 		$retvast = mysqli_query($link,$producz);
// 	if(! $retvast ){   die('Could not get data3: ' . mysqli_error($link));    }                         
// 	 while($rowz = mysqli_fetch_array($retvast, MYSQLI_ASSOC))
// 			 {	
// 			 $unitx=$rowz['unityp'];		
// 			  $qtyx=$rowz['quantity'];
// 			 $tot2=$unitx*$qtyx;
// 			 }
// 			 $dedamount=$tot1-$tot2;				 
//   $cx=mysqli_query ($link,"UPDATE verification SET amountde=$dedamount WHERE client_id='$id' AND orders_id='$oid'"); 
//   if(!$cx){ die('Could not Update data on line 65: ' . mysqli_error($link));    }	
	}
	}
	//=========================================
	// Mustapha code bigarukiraha
	//=========================================
	?>
</body>

</html>