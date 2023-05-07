<?php
session_start();
error_reporting(0);
include('includes/config.php');

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
	require 'PHPMailerAutoload.php';
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		echo $_SESSION['emailid'];
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		mysqli_query($con,"update orders set grand_total='".$paramList["TXNAMOUNT"]."',payment_mode='".$paramList["PAYMENTMODE"]."',	bank_txn_Id='".$paramList["BANKTXNID"]."',bank_name='".$paramList["BANKNAME"]."', orderId='".$paramList["ORDERID"]."' ,orderStatus='0',payment_order_date='".$paramList["PAYMENTMODE"]."' where userId='".$_SESSION['id']."'");


// $mail = new PHPMailer;
// $mail->Host = 'localhost';
// $mail->Port = 25;
// $mail->SMTPAuth = '';
// $mail->SMTPSecure = '';
// $mail->username = 'info@aaruinfotech.com';
// $mail->Password = 'Sapna@21';
// $mail->setFrom('info@aaruinfotech.com','aaruinfotech');
// $mail->addAddress($_SESSION['emailid']);
// $mail->addAddress('shejalesapna21@gmail.com');
// //$mail->addAddress('info@aaruinfotech.com');
// $mail->addReplyTo('ajitkamble123@gmail.com','aaruinfotech');
// $mail->isHTML(true);
// $mail->Subject='ordered place';
// $mail->Body='<h1 align=left>OrderID:'.$paramList["ORDERID"].'<br>
// 							bank_name:'.$paramList["BANKNAME"].'<br>
// 							bank_txn_Id:'.$paramList["BANKTXNID"].'<br>
// 							grand_total:'.$paramList["TXNAMOUNT"].'</h1>';

// 							if(!$mail->send()){
// 							echo "Something wrong Plz try again.";
// 							     echo 'Mailer Error: ' . $mail->ErrorInfo;
// 							}
// 							else
// 							{	
// 							echo "<script language='javascript' type='text/javascript'>";
// 							echo "alert('your order is placed');";
// 							echo "</script>";
// 							}


// unset($_SESSION['cart']);
// echo "<script>location='tran_pass.php'</script>";
// //header('location:http://aaruinfotech.com/online_shopping_portal/index.php');
}
else
	{
		echo "<b>Transaction status is failure</b>" . "<br/>";
		mysqli_query($con,"DELETE FROM orders WHERE userId='".$_SESSION['id']."'");	
		unset($_SESSION['cart']);
		echo "<script>location:tran_fail.php</script>";
		//header('location:http://aaruinfotech.com/online_shopping_portal/tran_fail.php');
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}


}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>