<?php require_once '../AppInfo.php'; ?>
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.init({
  appId      : '<?php echo AppInfo::appID(); ?>', // App ID
  channelUrl : '//<?php echo $_SERVER["HTTP_HOST"]; ?>/channel.html', // Channel File
  status     : true, // check login status
  cookie     : true, // enable cookies to allow the server to access the session
  xfbml      : true // parse XFBML
});

// Listen to the auth.login which will be called when the user logs in
// using the Login button
FB.Event.subscribe('auth.login', function(response) {
  // We want to reload the page now so PHP can read the cookie that the
  // Javascript SDK sat. But we don't want to use
  // window.location.reload() because if this is in a canvas there was a
  // post made to this page and a reload will trigger a message to the
  // user asking if they want to send data again.
  window.location = window.location;
});

FB.Canvas.setAutoGrow();
};

</script>