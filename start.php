<?php

require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/twitter-api/elgg-connect.php");

use Abraham\TwitterOAuth\TwitterOAuth;

elgg_register_event_handler('init', 'system', 'twcp_init');

function twcp_init() {
    
    //Adds the checkboxes below the compose for the Wire
    elgg_extend_view('twrc/fields', 'crossposting/checkboxes');

    //Our custom CSS
    elgg_extend_view('elgg.css', 'crossposting/css');

    //Register the callback pages
    elgg_register_page_handler('cross-posting', 'callback_handler');

    //Register the new wire post action
    //$action_base = __DIR__ . '/actions';
    //elgg_unregister_action('thewire/add');
    //elgg_register_action("thewire/add", "$action_base/add.php");

    //Extend the TWRC "add" action
    //twrc_extend_add_action("thewire-crossposting");

    elgg_register_plugin_hook_handler('twrc', 'add', 'twcp_hook');

}

function callback_handler($segments) {

    if ($segments[0] == 'twitter') {
        echo elgg_view_resource('cross-posting/twitter');
        return true;
    }

    return false;
}

function twcp_hook($hook, $type, $fields, $entity) {

    $twitter_oath_token = elgg_get_plugin_user_setting('twitter_oath_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');
    $twitter_oath_token_secret = elgg_get_plugin_user_setting('twitter_oath_token_secret', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

    if(isset($fields['rc_crosspost_twitter']) and $fields['rc_crosspost_twitter'] == "true" && isset($twitter_oath_token) && isset($twitter_oath_token_secret)) {

        $message = $entity->description;

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $twitter_oath_token, $twitter_oath_token_secret);    
        $connection->setTimeouts(10, 15);

        $statues = $connection->post("statuses/update", ["status" => $message]);

    }
    
    if (isset($fields['rc_crosspost_facebook']) and $fields['rc_crosspost_facebook'] == "true") {

        header("LOCATION: " . elgg_get_site_url() . "thewire?sharefb=" . $entity->guid);
        die();
    
    }

}
