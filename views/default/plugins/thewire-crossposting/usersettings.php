<?php

//This will add the Twitter API as well as the configured credentials
require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/twitter-api/elgg-connect.php");
use Abraham\TwitterOAuth\TwitterOAuth;

require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/facebook-api/elgg-connect.php");


$twitter_verified = elgg_get_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
$twitter_access_token = elgg_get_plugin_user_setting('twitter_access_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

$facebook_access_token = elgg_get_plugin_user_setting('facebook_access_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');


if (isset($_GET['revoke']) && $_GET['revoke'] == 'twitter') {

	elgg_unset_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');

} elseif (isset($_GET['revoke']) && $_GET['revoke'] == 'facebook') {

	elgg_unset_plugin_user_setting('facebook_access_token', elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');

}

?> 

<p>Simultaneously post to Facebook and/or Twitter when you make a post on <?php echo elgg_echo("thewire"); ?>.</p>

<h4>Connect your Facebook account:</h4>
<?php 

$permissions = ['email', 'user_posts'];
$loginUrl = $helper->getLoginUrl(elgg_get_site_url() . 'cross-posting/facebook', $permissions);

if(!$facebook_access_token || $_GET['revoke'] == 'facebook') {

	echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

} else {

    echo '<p style="color: #63A519;">You have already authenticated your Facebook. <a href="?revoke=facebook">Revoke</a>';

}

?>

<br /><br /><br />

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