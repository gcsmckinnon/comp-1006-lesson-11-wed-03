<?php

  // Connect to the database
  require("_connect.php");
  $conn = dbo();

  // destructure our values
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $email = strtolower($email);
  $password = filter_input(INPUT_POST, 'password');
  
  // Create our SQL with an email placeholder
  $sql = "SELECT * FROM users WHERE email = :email";
  
  // Prepare the SQL
  $stmt = $conn->prepare($sql);
  
  // Bind the value to the placeholder (incidently this will also sanitize the value)
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  
  // Execute
  $stmt->execute();

  // Check if we have a user and their password is correct
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $auth = false;

  if ($user) $auth = password_verify($password, $user['password']);

  session_start();
  if (!$auth) {
    $_SESSION["errors"][] = "Your email/password could not be verified.";
    $_SESSION["form_values"] = $_POST;

    header("Location: login.php");
    exit();
  }

  $_SESSION["user"] = $user;
  $_SESSION["successes"][] = "You have logged in successfully.";
  header("Location: profile.php");
  exit();