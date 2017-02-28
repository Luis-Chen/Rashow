<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="google-signin-client_id" content="437492255329-a1cdi19a8l3ul9lp9heste3b85bagpct.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <title></title>
  </head>
  <body>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <script type="text/javascript">
      function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
          location.herf="./test.php?value="+ profile.getEmail();
      }
    </script>
    <a href="#" onclick="signOut();">Sign out</a>
    <script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }
    </script>

  </body>
</html>
