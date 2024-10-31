<?php
// Function to connect to the database
function connectMainDB() {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "main_pos_database"; 
	
	//$servername = "localhost";
    //$username = "analyti1_pos_database"; // Replace with production username
    //$password = "Emmanuel2003@"; // Replace with production password
   // $dbname = "analyti1_pos_database"; // main database

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

##### Google App Configuration #####
$googleappid = "1032905930183-5iks9g0sq0pht8rg8u8mjblhqdi4lu98.apps.googleusercontent.com"; 
$googleappsecret = "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"; 
$redirectURL = "http://localhost/inventory/authenticate.php"; 

##### Required Library #####
include_once './Google/Google_Client.php';
include_once './Google/contrib/Google_Oauth2Service.php';

$googleClient = new Google_Client();
$googleClient->setApplicationName('Analytix Boost');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($googleClient);

