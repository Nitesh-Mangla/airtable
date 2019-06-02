<?php

if( isset($_POST['SUBMIT']) )
{
	$name = $_POST['first_name'].' '.$_POST['last_name'];
	$email = $_POST['email'];
	$pass = $_POST['user_password'];
	$phone = $_POST['contact_no'];

	$target = 'images/'.$_FILES["file"]["name"];

	if( move_uploaded_file($_FILES["file"]["tmp_name"], $target) ){

		$url = "https://api.airtable.com/v0/appjxBxFrzl0qJaRx/userLogin";
            $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer keyZGr94G0xa7gxiw'
            );

           $data['fields']['username'] = $email;
           $data['fields']['name']     = $name;
           $data['fields']['password'] = $pass;
           $data['fields']['phone no'] = $phone;
           // $data['fields']['image']['url']    = "https://dl.airtable.com/.attachments/6fc257c20c8d83595edf667fe8ab96ba/73e7aead/".$_FILES['file']['name'];


         $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, true));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
      
        curl_close($ch);
        print_r($result);
          
	}else{
		echo "ff";
	 	print_r($_FILES['file']['error']);
	}
}