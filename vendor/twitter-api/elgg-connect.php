<?php
//This file will be included in all pages that need to access the Twitter API for cross-posting

//Requires the actual API
require(elgg_get_plugins_path() . "thewire-crossposting" . "/vendor/twitter-api/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;


//Let's set the correct credentials :)
define('CONSUMER_KEY', elgg_get_plugin_setting('crossposting_twitter_consumerkey', 'thewire-crossposting'));
define('CONSUMER_SECRET', elgg_get_plugin_setting('crossposting_twitter_consumersecret', 'thewire-crossposting'));
define('OAUTH_CALLBACK', elgg_get_site_url() . 'cross-posting/twitter');