<?php
require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/facebook-api/autoload.php");

$fb = new Facebook\Facebook([
    'app_id' => elgg_get_plugin_setting('crossposting_facebook_appid', 'thewire-crossposting'),
    'app_secret' => elgg_get_plugin_setting('crossposting_facebook_appsecret', 'thewire-crossposting'),
    'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();