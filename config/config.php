<?php 

  $server = 'localhost';
  $username = 'root';
  $password = 'pw12345';
  $db_name = 'pharmacy_kiosk';

  $conn = new mysqli($server, $username, $password, $db_name);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $base_url = $_SERVER['SERVER_NAME'];
?>