<div style="width: 10px; height: 30px;"></div>
<p><strong>Cross-Posting for Facebook:</strong></p>

<p>1. Create a new app on <a href="https://developers.facebook.com/" target="_blank">Facebook for Developers</a>.</p>
<p>2. Select the "Integrate Facebook Login" scenario:</p>
<img src="https://i.gyazo.com/8faf26f1af8c27ef8a97839ab831602e.png" style="border: 2px dashed #ccc;" width="600" />
<br /><br />
<p>3. Make sure you add your site's domain name under "App Domains:"</p>
<img src="https://i.gyazo.com/0667516a93d35ff48bbbad141e695ecf.png" style="border: 2px dashed #ccc;" />
<br /><br />
<p>4. Press the "Add Platform" button below the "Data Protection Officer Contact Information."</p>
<p>5. Select the "Website" option:</p>
<img src="https://i.gyazo.com/bc4d5b70faeb99073cb57fb0d7b1a41a.png" width="500" style="border: 2px dashed #ccc;"/>
<br /><br />
<p>6. Add the URL of your elgg installation under "Site URL:"</p>
<img src="https://i.gyazo.com/56accf80077d432c756b66ae35bb84bb.png" style="border: 2px dashed #ccc;" />
<br /><br />
<p>7. Press "Save changes."</p>
<p>8. Go to the "Settings" page for Facebook Login in the sidebar:</p>
<img src="https://i.gyazo.com/63ba5c3084581ca88b4fe9c10dc7fcd6.png" style="border: 2px dashed #ccc;">
<br /><br />
<p>9. Make sure you have these settings (with <em>elgg-site.com</em> as the URL of your elgg site): </p>
<img src="https://i.gyazo.com/0b1afeee1341da62d4532722a28e6092.png" style="border: 2px dashed #ccc;" width="600" />
<br /><br />
<p>10. Go to the "Basic Settings" page for your Facebook App and get the App ID and App Secret:</p>
<img src="https://i.gyazo.com/97542651032e34eb43486f9e61a6a19c.png" style="border: 2px dashed #ccc;" />
<br /><br />
<strong>App ID:</strong> <input type="text" name="params[crossposting_facebook_appid]" value="<?php echo elgg_get_plugin_setting('crossposting_facebook_appid', 'thewire-crossposting'); ?>" />

<br /><br /><strong>App Secret:</strong> <input type="text" name="params[crossposting_facebook_appsecret]" value="<?php echo elgg_get_plugin_setting('crossposting_facebook_appsecret', 'thewire-crossposting'); ?>" />


<div style="width: 10px; height: 30px;"></div>
<p><strong>Cross-Posting for Twitter:</strong></p>
<p>1. Apply for a <strong><a href="https://developer.twitter.com/en/apply/" target="_BLANK">developer account</strong> on Twitter.</p>
<p>2. <strong><a href="https://developer.twitter.com/en/apps/create" target="_BLANK">Create an app</a></strong> from your approved developer account.</p>
<p>3. Make sure you have these settings (with <em>elgg-site.com</em> as the URL of your elgg site): </p>
<img src="https://i.gyazo.com/bd91c2adb75f494b9842bc0088dc01ff.png" style="border: 2px dashed #ccc;">

<br /><br />
<p>4. Go to the <strong><a href="https://support.yapsody.com/hc/en-us/articles/360003291573-How-do-I-get-a-Twitter-Consumer-Key-and-Consumer-Secret-key-" target="_BLANK">Keys and tokens</a></strong> section to get your API keys</p>

<strong>Consumer Key:</strong> <input type="text" name="params[crossposting_twitter_consumerkey]" value="<?php echo elgg_get_plugin_setting('crossposting_twitter_consumerkey', 'thewire-crossposting'); ?>" />

<br /><br /><strong>Consumer Secret:</strong> <input type="text" name="params[crossposting_twitter_consumersecret]" value="<?php echo elgg_get_plugin_setting('crossposting_twitter_consumersecret', 'thewire-crossposting'); ?>" />

<br /><br />