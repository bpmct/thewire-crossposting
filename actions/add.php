<?php

require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/twitter-api/elgg-connect.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$twitter_oath_token = elgg_get_plugin_user_setting('twitter_oath_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
$twitter_oath_token_secret = elgg_get_plugin_user_setting('twitter_oath_token_secret', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
$crosspost_twitter = get_input('crosspost-twitter', '', false);

$post_contents = get_input('body', '', false);
$owner_guid = elgg_get_logged_in_user_entity()->guid;

// make sure the post isn't blank
if ($crosspost_twitter && !empty($post_contents) && isset($twitter_oath_token)) {
    
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_oath_token, $twitter_oath_token_secret);    
    $connection->setTimeouts(10, 15);

    $statues = $connection->post("statuses/update", ["status" => $post_contents]);

}


//Now let's actually make the wire post, like we would normally :)
require_once(elgg_get_plugins_path() . "/thewire/actions/add.php");