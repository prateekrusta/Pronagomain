<?php

$oname = $_POST['oname'];
$cname = $_POST['cname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$addresss = $_POST['addresss'];
$city = $_POST['city'];
$states = $_POST['states'];
$zip = $_POST['zip'];
$gstin = $_POST['gstin'];
$textareaa = $_POST['textareaa'];

if(!empty($oname) || !empty($cname) || !empty($phone) || !empty($email) || !empty($addresss) || !empty($city) || !empty($states) || !empty($zip) || !empty($gstin) || !empty($textareaa) )
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "pronago";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else {
        $SELECT = "SELECT email From pronagojoinus Where email = ? Limit 1";
        $INSERT = "INSERT Into pronagojoinus (oname, cname, phone, email, addresss, city, states, zip, gstin, textareaa) values(?, ?, ?, ?, ?, ?, ?, ? ,?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $stmt->store_result();
        $stmt->fetch();
        $rnum = $stmt->num_rows;
        if ($rnum==0) {
         $stmt->close();
         $stmt = $conn->prepare($INSERT);
         $stmt->bind_param("ssissssiss", $oname, $cname, $phone, $email, $addresss, $city, $states, $zip, $gstin, $textareaa);
         $stmt->execute();
         echo "New record inserted sucessfully";
        } else {
         echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
       }
   }
else{
    echo "All field are required";
    die();
}

?>