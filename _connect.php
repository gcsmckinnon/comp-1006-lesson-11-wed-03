<?php

  /*
    By converting the connect script into a function,
    we increase its versatility and avoid the potential
    of symbol naming collisions.
  */
  function dbo () {
    try {
      $dsn = 'mysql:host=localhost;dbname=database';
      $username = 'root'; 
      $password = '';

      $db = new PDO($dsn,$username, $password); 

      // This attribute ensures that any SQL errors are reported
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $db;
    } catch (PDOException $error) {
      var_dump("Issue connecting: {$error->getMessage()}");
      exit();
    }
  }