<?php 
session_start();

## Require connection file
require_once './conn.php';

## Establish the connection to the database
$conn = connectMainDB();

if(isset($_GET['code'])){
	$googleClient->authenticate($_GET['code']);
	$_SESSION['token'] = $googleClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}
############ Set Google access token ############
if (isset($_SESSION['token'])) {
	$googleClient->setAccessToken($_SESSION['token']);
}

if ($googleClient->getAccessToken()) {
	############ Fetch data from graph api  ############
	try {
		$gpUserProfile = $google_oauthV2->userinfo->get();
	}
	catch (\Exception $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		header("Location: ./");
		exit;
	}

	############ Store data in database ############
	$oauthpro = "Google";
	$authenticated = 1;
	$oauthid = $gpUserProfile['id'] ?? '';
	$f_name = $gpUserProfile['given_name'] ?? '';
	$email_id = $gpUserProfile['email'] ?? '';
	$picture = $gpUserProfile['picture'] ?? '';

	$sql = "SELECT * FROM users WHERE email='".$email_id."'";
	$result = $conn->query($sql);

	if ($result->num_rows === 1) {
		## Update the existing user with only the defined variables
		$conn->query("UPDATE users SET oauth_pro='".$oauthpro."', oauth_id='".$oauthid."', oauth_fname='".$f_name."', oauth_picture='".$picture."',  is_verified='".$authenticated."' WHERE email='".$email_id."'");
	} else {
		## Insert new user with only the defined variables
		$conn->query("INSERT INTO users (oauth_pro, oauth_id, oauth_fname, email, oauth_picture, is_verified) VALUES ('".$oauthpro."', '".$oauthid."', '".$f_name."', '".$email_id."', '".$picture."', '".$authenticated."')");
	}

	$res = $conn->query($sql);
	$userData = $res->fetch_assoc();

	$_SESSION['userData'] = $userData;
	### Set session that will be used to verify users ###
	$_SESSION['authenticated'] = true;
	$_SESSION['email'] = $email_id;
	$_SESSION['username'] = $f_name;
	header("Location: ./index.php");

} else {
	header("Location: ./");
}
?>
