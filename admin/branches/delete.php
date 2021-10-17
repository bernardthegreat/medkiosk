<?php
  require "../../config/config.php";
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
  }

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
      $sql = "delete from branches where id = '$id'";
      $result = $conn->query($sql);
      $message = "Successfully deleted!";
      header("Location:index.php?message=".$message);
    } catch (Exception $e) {
      $message = "Error deleting!". $e->get_message();
      header("Location:index.php?message=".$message);
    }
  }
?>
