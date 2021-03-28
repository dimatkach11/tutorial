<?php
  session_start();

  if(isset($_SESSION['session_name'])) {
    unset($_SESSION['session_name']);
    session_destroy();
    header("location: /tutorial/");
  } else {
    print_r($_SESSION);
  }