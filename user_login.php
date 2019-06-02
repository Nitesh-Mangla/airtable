<?php

if( isset($_POST['submit']) ){

	$username = $_POST['username'];
	$pass = $_POST['password'];

	$url = "https://api.airtable.com/v0/appjxBxFrzl0qJaRx/userLogin";
            $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer keyZGr94G0xa7gxiw'
            );
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $data = curl_exec($ch);
            curl_close($ch);
            $page_data['api']= $data;
             $json_data = json_decode($data);

             foreach( $json_data->records as $value ){
             			
             			if( $value->fields->password == '123' ){
             		$url = "https://api.airtable.com/v0/appjxBxFrzl0qJaRx/userLogin/".$value->id;
            $headers = array(
           
            'Authorization: Bearer keyZGr94G0xa7gxiw'
            );
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($value->fields));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $data = curl_exec($ch);
           	print_r($data);

             curl_close($ch);
             	
             }
         }

}