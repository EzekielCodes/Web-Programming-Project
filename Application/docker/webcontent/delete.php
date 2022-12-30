<?php

session_start();
// Include config file
require_once "includes/config.php";

/**
 * Includes
 * ----------------------------------------------------------------
 */

// config & functions
//require_once 'includes/config.php';
require_once 'includes/functions.php';



    
if( isset($_GET["idcordinaten"])){

    $param_id = $_GET["idcordinaten"];
    echo $param_id;
    /**
     * Database Connection
     * ----------------------------------------------------------------
     */

    // @TODO
    $pdo = getDatabase();

    $sql = "DELETE FROM cordinaten WHERE idcordinaten= ?";
    $result = $pdo->prepare($sql);
    $result->execute([$param_id]);


    
}
header("location: savedMaps.php");
exit;

?>