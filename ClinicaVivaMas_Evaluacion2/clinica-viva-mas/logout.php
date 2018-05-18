<?php

session_start();

session_destroy();

unset($_SESSION['loginUser']);

header("location:index.php");

