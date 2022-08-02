<?php
session_name('Mantenedor');
@session_start();
session_destroy();
header("Location: index.php");
?>