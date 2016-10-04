<?php 

    require("common.php"); 
     
    unset($_SESSION['user']); 
     
    header("Location: datagenerator.php"); 
    die("Redirecting to: datagenerator.php");