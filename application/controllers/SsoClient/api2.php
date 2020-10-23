<?php
 
 
$postData = array(
    
                'method'=>'getUsernameList',
                'params'=>array('357b436e445f334340352b34747b70573975352d683152562c27792847'),
                'id'=>1
        

);
	 
#echo $strParams;
// Setup cURL
$ch = curl_init('http://cacti.moratelindo.co.id/api/cacti.php');
curl_setopt_array($ch, array(
    CURLOPT_POST => FALSE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ,'Content-type: application/x-www-form-urlencoded'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
    die(curl_error($ch));
}
//var_dump($response);

// Decode the response
$responseData = json_decode($response, TRUE);

 print_r($responseData);