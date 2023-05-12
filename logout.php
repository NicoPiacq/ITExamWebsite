<?php 

error_reporting(E_ALL);

include("conn_db.php");
include("pages_settings.php");

session_destroy();
header("Location: index.php?msg=logout");

?>