<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!='superadmin'){
    header('HTTP/1.1 403 Forbidden');
    die('ACCESS DENIED: Superadmin only');
}
?>
