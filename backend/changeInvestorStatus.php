<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "../handlerDbConnection.php";

$ref = htmlspecialchars($_POST['ref']);
$status = htmlspecialchars($_POST['status']);

if($status == 'pending'){
    $status = 'active';
    
}else{
    $status = 'pending';
}


$sql = "UPDATE investors SET account_status='". $status ."' WHERE reference_code='" . $ref . "'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


echo $ref ;