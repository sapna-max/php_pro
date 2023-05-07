<?php
date_default_timezone_set("Asia/Calcutta");
$db = "online_shopping";
$username = "root";
$password = "";
//$username = "r4gz8zfz2kih";
 // $password = "OneRupee@1";
$conn = new PDO("mysql:host=localhost;dbname=$db", $username, $password);

include ('classess/admin.php');
