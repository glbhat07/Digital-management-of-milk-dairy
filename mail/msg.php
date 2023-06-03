<?php

// Set your MSG91 API credentials
$authKey = '397769AubYEZNmj6475d622P1'; // Replace with your actual AuthKey
$senderId = 'jitbit'; // Replace with your actual Sender ID

// Set the message details
$mobileNumber = '8296717694'; // Replace with the recipient's mobile number
$message = 'Hello, this is a test message.'; // Replace with the desired message content

// Prepare the data for the API request
$data = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId
);
$url = 'https://api.msg91.com/api/v2/sendsms';
$url1 = "http://api.msg91.com/api/sendhttp.php";

// Create the cURL request
$ch = curl_init($url);

curl_setopt_array($ch,array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER-> true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS-> $data


));

//Ignore SSL certificate verification
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the API request
$response = curl_exec($ch);

// Check for errors or handle the response as needed
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Process the response
    $responseData = json_decode($response, true);
    if ($responseData['type'] === 'success') {
        echo 'SMS sent successfully!';
    } else {
        echo 'Failed to send SMS: ' . $responseData['message'];
    }
}

// Close the cURL request
curl_close($ch);

?>