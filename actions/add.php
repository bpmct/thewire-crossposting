<?php

require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/twitter-api/elgg-connect.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$twitter_oath_token = elgg_get_plugin_user_setting('twitter_oath_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
$twitter_oath_token_secret = elgg_get_plugin_user_setting('twitter_oath_token_secret', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
$crosspost_twitter = get_input('crosspost-twitter', '', false);
$crosspost_facebook = get_input('crosspost-facebook', '', false);


$post_contents = get_input('body', '', false);
$owner_guid = elgg_get_logged_in_user_entity()->guid;

// make sure the post isn't blank
if ($crosspost_twitter && !empty($post_contents) && isset($twitter_oath_token)) {
    
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_oath_token, $twitter_oath_token_secret);    
    $connection->setTimeouts(10, 15);

    $statues = $connection->post("statuses/update", ["status" => $post_contents]);

}

// don't filter since we strip and filter escapes some characters
$body = get_input('body', '', false);

$access_id = ACCESS_PUBLIC;
$method = 'site';
$parent_guid = (int) get_input('parent_guid');

// make sure the post isn't blank
if (empty($body)) {
	register_error(elgg_echo("thewire:blank"));
	forward(REFERER);
}

$guid = thewire_save_post($body, elgg_get_logged_in_user_guid(), $access_id, $parent_guid, $method);
if (!$guid) {
	register_error(elgg_echo("thewire:notsaved"));
	forward(REFERER);
}

// if reply, forward to thread display page
if ($parent_guid) {
	$parent = get_entity($parent_guid);
	forward("thewire/thread/$parent->wire_thread");
}

//make sure post isn't blank for FB too
if ($crosspost_facebook && !empty($post_contents)) {

    header("LOCATION: " . elgg_get_site_url() . "thewire?sharefb=" . $guid);
    die();

} else {

//refer as normal

system_message(elgg_echo("thewire:posted"));
forward(REFERER);

}