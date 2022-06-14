<?php
session_start();
// hủy session
session_destroy();
header('Location:index.php');
?>