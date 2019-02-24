<?php
require_once(elgg_get_plugins_path() . "thewire-crossposting/vendor/facebook-api/elgg-connect.php");

try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    die('Graph returned an error: ' . $e->getMessage());
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    die('Facebook SDK returned an error: ' . $e->getMessage());
    exit;
  }
  
  if (! isset($accessToken)) {
    if ($helper->getError()) {
      header('HTTP/1.0 401 Unauthorized');
      die("Error: " . $helper->getError() . "\n"
      . "Error Code: " . $helper->getErrorCode() . "\n"
      . "Error Reason: " . $helper->getErrorReason() . "\n"
      . "Error Description: " . $helper->getErrorDescription() . "\n");
    } else {
      header('HTTP/1.0 400 Bad Request');
      die('Bad request');
    }
    exit;
  }
  
  $oAuth2Client = $fb->getOAuth2Client();
  $tokenMetadata = $oAuth2Client->debugToken($accessToken);
  
  $tokenMetadata->validateAppId(elgg_get_plugin_setting('crossposting_facebook_appid', 'thewire-crossposting'));
  
  $tokenMetadata->validateExpiration();
  
  if (! $accessToken->isLongLived()) {

    try {

      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

    } catch (Facebook\Exceptions\FacebookSDKException $e) {

        die("<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n");
        
        exit;

    }

}
  
elgg_set_plugin_user_setting('facebook_access_token', (string) $accessToken, elgg_get_logged_in_user_entity()->guid,  'thewire-crossposting');

echo "<script type='text/javascript'>window.top.location='". elgg_get_site_url() . "thewire';</script>"; exit;