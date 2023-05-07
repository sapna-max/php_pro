<?php
session_start();
error_reporting(0);
include('includes/config.php');

	$email=$_POST['email'];
    $contact=$_POST['contactno'];
    $password=md5($_POST['password']);
    mysqli_query($con,"update users set password='$password' WHERE email='$email' and contactno='$contact' ");
     //$con->query("update users set password='$password' WHERE email='$email' and contactno='$contact'");
?>