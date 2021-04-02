<?php
  // unset($_SERVER['PHP_AUTH_USER']);
  if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="The Registration"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Log in fool";
  } else {
    if ($_SERVER['PHP_AUTH_USER'] !== "bob") {
      echo "Log in with the correct username";
      exit();
    }

    if ($_SERVER['PHP_AUTH_PW'] !== "ilikepuppies") {
      echo "Log in with the correct password";
      exit;
    }

    echo "You have gained access!!!";
  }

?>