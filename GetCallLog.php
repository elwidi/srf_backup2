<?php
     
       $ch = curl_init(); 
	$url = "http://sf.apps.moratelindo.co.id/cronjob/get_call_log";
        
       curl_setopt($ch, CURLOPT_URL, $url); 

       //return the transfer as a string 
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

       // $output contains the output string 
       $output = curl_exec($ch); 

       // close curl resource to free up system resources 
       curl_close($ch);  
    
	echo $output;
?>