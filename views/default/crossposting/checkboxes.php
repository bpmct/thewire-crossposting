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
       
    theMessage = document.getElementById("thewire-textarea").value;

    var url = theMessage.match(/\bhttps?:\/\/\S+/gi);

    if (url != null) {
    
        url = url[0];

    } else {

        url = "http://socalstory.com/profile/bpmct";

    }

    FB.ui({
         method: 'share',
         quote: theMessage,
         href: url
    }, function(response){});

   }

</script>

<?php

//Redirect onClick for when Facebook or Twitter is not configured
$site_url = elgg_get_site_url();
$li_username = elgg_get_logged_in_user_entity()->username;
$onclick_value = "onClick=\"if (this.checked) { window.location = '{$site_url}settings/plugins/{$li_username}/thewire-crossposting'; }\"";
$twitter_verified = elgg_get_plugin_user_setting('twitter_verified', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

$facebook_access_token = elgg_get_plugin_user_setting('facebook_access_token', elgg_get_logged_in_user_entity()->guid, 'thewire-crossposting');

?>

<div class="crossposting-checkboxes">
    <label for="crosspost-facebook">
        <input type="checkbox" id="crosspost-facebook" name="crosspost-facebook" value="true" onclick="shareFB();"> 
        Post to Facebook
    </label>
    <label for="crosspost-twitter">
        <input type="checkbox" id="crosspost-twitter" name="crosspost-twitter" value="true" <?php if (!$twitter_verified) { echo $onclick_value; } ?>>  
        Post to Twitter
    </label>
</div>