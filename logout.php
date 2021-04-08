<?php

  session_start();
  if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
  }

  unset($_SESSION['user']);
  $_SESSION['successes'][] = "You have been logged out successfully.";

  header("Location: index.php");
  exit();