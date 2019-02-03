<?php

//Redirect onClick for when Facebook or Twitter is not configured
$site_url = elgg_get_site_url();
$li_username = elgg_get_logged_in_user_entity()->username;
$onclick_value = "onClick=\"if (this.checked) { window.location = '{$site_url}settings/plugins/{$li_username}/thewire-crossposting'; }\"";
$twitter_verified = elgg_get_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

?>

<div class="crossposting-checkboxes">
    <label for="crosspost-facebook">
        <input type="checkbox" id="crosspost-facebook" name="crosspost-facebook" value="true"> 
        Post to Facebook
    </label>
    <label for="crosspost-twitter">
        <input type="checkbox" id="crosspost-twitter" name="crosspost-twitter" value="true" <?php if (!$twitter_verified) { echo $onclick_value; } ?>>  
        Post to Twitter
    </label>
</div>