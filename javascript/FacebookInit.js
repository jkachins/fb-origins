function logResponse(response) {
  if (console && console.log) {
    console.log('The response was', response);
  }
}

$(function(){
  // Set up so we handle click on the buttons
  $('#postToWall').click(function() {
    FB.ui(
      {
        method : 'feed',
        link   : $(this).attr('data-url')
      },
      function (response) {
        // If response is null the user canceled the dialog
        if (response != null) {
          logResponse(response);
        }
      }
    );
  });

  $('#sendToFriends').click(function() {
    FB.ui(
      {
        method : 'send',
        link   : $(this).attr('data-url')
      },
      function (response) {
        // If response is null the user canceled the dialog
        if (response != null) {
          logResponse(response);
        }
      }
    );
  });

  $('#sendRequest').click(function() {
    FB.ui(
      {
        method  : 'apprequests',
        message : $(this).attr('data-message')
      },
      function (response) {
        // If response is null the user canceled the dialog
        if (response != null) {
          logResponse(response);
        }
      }
    );
  });
});


// Load the SDK Asynchronously
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));