<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
// Include config file
require_once "includes/config.php";

/**
 * Includes
 * ----------------------------------------------------------------
 */

// config & functions
//require_once 'includes/config.php';
require_once 'includes/functions.php';



    
    /**
     * Database Connection
     * ----------------------------------------------------------------
     */

    // @TODO
  
    $param_id = "";
    $name = "";
    $latitude = "";
    $longitude = "";
    $pdo = getDatabase();

    $param_id = $_GET["idcordinaten"];

    $sql = " SELECT * FROM cordinaten Where idcordinaten=?";
    
    $result = $pdo->prepare($sql);
    $result->execute([$param_id]);
    $rows=$result->fetch(PDO::FETCH_ASSOC);

    $name = $rows["name"];
    $latitude = $rows["latitude"];
    $longitude = $rows["longitude"];

    if(isset($_POST['submit'])){
      
      if(isset($_POST['visited'])){
        $selected = $_POST['visited'];
      $sql = 'UPDATE cordinaten SET visited =? WHERE idcordinaten= ?';
      $stmt = $pdo-> prepare($sql);
      $stmt->execute([$selected,$param_id]);

       header("location: savedMaps.php");
      exit;
      }
    }
  



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
</head>
<body  class="h-100 d-flex align-items-center justify-content-center" style="margin: 50px">
    <!-- Modal -->
    <form action=""  method="POST">
    <input type = "hidden" value="<?php echo $idcordinaten; ?>"> 
    
    <label for="inputCityName">Name</label>
    <input type="text" class="form-control" id="inputName" disabled name = "inputName" value="<?php echo $name;?>">
  

    <label for="inputCityLatitude">Latitude</label>
    <input type="text" name = "inputlatitude" class="form-control" disabled id="inputLatitude" value="<?php echo $latitude;?>">

    <label for="inputCityLongitude">longitude</label>
    <input name = "inputlongitude" type="text" class="form-control" disabled id="inputLongitude" value="<?php echo $longitude;?>">
    <label>Have you visited this place?</label>
      <br>
      <select name="visited">
        <option value="" selected disabled hidden>Choose here</option> 
        <option value="No">No</option>
        <option value="Yes">Yes</option>
      </select><br><br>
    <input type="submit" name= "submit" value="send">
    </form>
</body>
</html>