<?php

//First form - personal data
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$address1 = $_POST["addres1"];
$addres2 = $_POST["addres2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$phone = $_POST["phone"];

//Second form - products
$qty1 = $_POST["qty1"];
$qty2 = $_POST["qty2"];
$qty3 = $_POST["qty3"];
$qty4 = $_POST["qty4"];
$qtyTotalPrice1 = $qty1 * 799;
$qtyTotalPrice2 = $qty2 * 499;
$qtyTotalPrice3 = $qty3 * 199;

//Third form - Payment method
$paymentMethod = $_POST["paymentMethod"];
$ccNumber = $_POST["ccNumber"];
$ccCode = $_POST["ccCode"];
$expirationDate = $_POST["expirationDate"];

echo "
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <script type='text/javascript' src='script.js'></script>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <title>CS 213 Week 07/Check Out</title>
</head>
    <body>
        <h1>Order Confirmation</h1>
    <table border='1'>
        <th>Qty</th>
        <th>Product</th>
        <th>Image</th>
        <th>Unit. Price</th>
        <th>Total Price</th>
        <tr>
            <td>
                $qty1
            </td>
            <td>
                Desktop HP Core I5, 1TB Hard disk, 8GB memory, DVD-RW, Windows 10 Pro, Office 2016 Pro, 36m warranty, Monitor 21,5'
            </td>
            <td>
                <img class='img-form' src='tablethp.jpg' alt='desk hp' />
            </td>
            <td>
                U$ 799.00
            </td>
            <td>
                U$ $qtyTotalPrice1.00
            </td>
        </tr>
        <tr>
            <td>
                $qty2
            </td>
            <td>
                Notebook HP Core I3, 500GB Hard disk, 4GB memory, DVD-RW, Windows 10 Pro, Office 2016 Pro, 36m warranty, Screen 14
            </td>
            <td>
                <img class='img-form' src='notehp.jpg' alt='note hp' />
            </td>
            <td>
                $ 499.00
            </td>
            <td>
                U$ $qtyTotalPrice2.00
            </td>
        </tr>
        <tr>
            <td>
                $qty1
            </td>
            <td>
                $qty1
            </td>
            <td>
                $qty1
            </td>
            <td>
                $qty1
            </td>
        </tr>
            
        
        
            
                


"

?>