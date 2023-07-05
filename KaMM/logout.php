<?php
session_start();
if(isset($_POST['logout'])) {
  echo "<script>if(confirm('Are you sure you want to logout?')) {";
  $_SESSION = array();
  session_destroy();
  echo "window.location.href = 'welcome.html';";
  echo "}</script>";
}
