function sendRequest() {
FB.ui(
    {
      method  : 'apprequests',
      message : "Join this game I'm running!",
      data    : $(this).attr('data-data')
    },
    function (response) {
      // If response is null the user canceled the dialog
      if (response != null) {
        logResponse(response);
      }
    }
  );
}