<?php

//This will add the Twitter API as well as the configured credentials
require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/twitter-api/elgg-connect.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$twitter_verified = elgg_get_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
$twitter_access_token = elgg_get_plugin_user_setting('twitter_access_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

if (isset($_GET['revoke']) && $_GET['revoke'] == 'twitter') {

	elgg_unset_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');

}

?> 

<p>Simultaneously post to Twitter when you make a post on <?php echo elgg_echo("thewire"); ?>.</p>

<br />

<h4>Connect your Twitter account:</h4>

<?php 

if($twitter_verified && $_GET['revoke'] != 'twitter') {

    echo '<p style="color: #63A519;">You have already authenticated your Twitter. <a href="?revoke=twitter">Revoke</a>';

} else {

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

	echo "<a href='$url'><img src='". elgg_get_site_url() . "mod/thewire-crossposting/vendor/twitter-api/twitter-login-blue.png' height='30' style='margin-left:1%; margin-top: 1%'></a>";

}


?>

<br /><br />