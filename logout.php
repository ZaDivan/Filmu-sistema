<?php
require ("db.php");
session_start();
session_unset();
session_destroy();

header('location:viesis.php');

?>