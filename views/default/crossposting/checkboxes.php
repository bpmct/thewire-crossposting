<?php

//Redirect onClick for when Twitter is not configured
$site_url = elgg_get_site_url();
$li_username = elgg_get_logged_in_user_entity()->username;
$onclick_value = "onClick=\"if (this.checked) { window.location = '{$site_url}settings/plugins/{$li_username}/thewire-crossposting'; }\"";
$twitter_verified = elgg_get_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

$facebook_appid = elgg_get_plugin_setting('crossposting_facebook_appid', 'thewire-crossposting');
$twitter_key = elgg_get_plugin_setting('crossposting_twitter_consumerkey', 'thewire-crossposting');


if (isset($_GET['sharefb'])) {
    
    $wire_post_description = get_entity(intval($_GET['sharefb']))->description;

?>

<script type="text/javascript">

window.fbAsyncInit = function() {
    FB.init({
      appId            : "<?php echo elgg_get_plugin_setting('crossposting_facebook_appid', 'thewire-crossposting'); ?>",
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function shareFB() {
       
    theMessage = `<?php echo json_encode($wire_post_description); ?>`;

    var url = theMessage.match(/\bhttps?:\/\/\S+/gi);

    if (url != null) {
    
        url = url[0];

    } else {

        <?php if (elgg_plugin_exists("hypeDiscovery")) { ?>
            url = "<?php echo elgg_get_site_url() . "permalink/default/" . intval($_GET['sharefb']); ?>";
        <?php } else { ?>
            url = "<?php echo elgg_get_site_url() . "profile/" . elgg_get_logged_in_user_entity()->username; ?>";
        <?php } ?>

    }

    FB.ui({
         method: 'share',
         quote: theMessage,
         href: url
    }, function(response){});

   }
    window.onload = shareFB;
        
</script>

<?php } ?>

<div class="crossposting-checkboxes">
    <?php if (isset($facebook_appid) && $facebook_appid != null) { ?>
    <label for="crosspost-facebook">
        <input type="checkbox" id="crosspost-facebook" name="crosspost-facebook" value="true"> 
        Share on Facebook
    </label>
    <?php } if (isset($twitter_key) && $twitter_key != null) { ?>
    <label for="crosspost-twitter">
        <input type="checkbox" id="crosspost-twitter" name="crosspost-twitter" value="true" <?php if (!$twitter_verified) { echo $onclick_value; } ?>>  
        Post to Twitter
    </label>
    <?php } ?>
</div>