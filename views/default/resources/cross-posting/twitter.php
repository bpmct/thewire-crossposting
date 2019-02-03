<?php

//This will add the Twitter API as well as the configured credentials
require(elgg_get_plugins_path() . "thewire-crossposting" . "/vendor/twitter-api/elgg-connect.php");
use Abraham\TwitterOAuth\TwitterOAuth;

//Logged in users only
gatekeeper();

//Let's check to see if the user's access token was sent.
if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']) {

	$request_token = [];
	$request_token['oauth_token'] = $_SESSION['oauth_token'];
	$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
	$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

    //Adds the access tokens to the user's settings.
    elgg_set_plugin_user_setting('twitter_verified', true, elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');
    elgg_set_plugin_user_setting('twitter_oath_token', $access_token['oauth_token'], elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');
    elgg_set_plugin_user_setting('twitter_oath_token_secret', $access_token['oauth_token_secret'], elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');

    unset($_SESSION['oauth_token']);
    unset($_SESSION['oauth_token_secret']);
    
    header("LOCATION: " . elgg_get_site_url() . "thewire");

    die();
    
} else {

    die("No access token was sent with this request.");

}