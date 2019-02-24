<div style="width: 10px; height: 30px;"></div>
<p><strong>Cross-Posting for Facebook:</strong></p>

<p>1. Create a new app on <strong><a href="https://developers.facebook.com/" target="_blank">Facebook for Developers</a></strong>.</p>
<p>2. Make sure you add the your site as the proper domain and take the site <strong><a href="https://developers.facebook.com/docs/apps/managing-development-cycle/" target="_blank">out of development mode</a></strong>.</p>

<strong>App ID:</strong> <input type="text" name="params[crossposting_facebook_appid]" value="<?php echo elgg_get_plugin_setting('crossposting_facebook_appid', 'thewire-crossposting'); ?>" />

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