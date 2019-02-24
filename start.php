<?php

elgg_register_event_handler('init', 'system', 'twcp_init');

function twcp_init() {
    
    //Adds the checkboxes below the compose for the Wire
    elgg_extend_view('forms/thewire/add', 'crossposting/checkboxes');

    //Our custom CSS
    elgg_extend_view('elgg.css', 'crossposting/css');

    //Register the callback pages
    elgg_register_page_handler('cross-posting', 'callback_handler');

    //Register the new wire post action
    $action_base = __DIR__ . '/actions';
    elgg_unregister_action('thewire/add');
    elgg_register_action("thewire/add", "$action_base/add.php");


}

function callback_handler($segments) {

    if ($segments[0] == 'twitter') {
        echo elgg_view_resource('cross-posting/twitter');
        return true;
    } 
    
    if ($segments[0] == 'facebook') {
        echo elgg_view_resource('cross-posting/facebook');
        return true;
    }

    return false;
}
