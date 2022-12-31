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



    
    /**
     * Database Connection
     * ----------------------------------------------------------------
     */

    // @TODO
  
    $param_id = "";
    $pdo = getDatabase();

    if(isset($_POST['submit'])){
      $param_id = $_GET["idcordinaten"];
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
    <title>Document</title>
</head>
<body>
    <!-- Modal -->
        <form action=""  method="POST">
        <input type = "hidden" value="<?php echo $idcordinaten; ?>">  
        <label>Have you visited this place?</label>
          <br>
          <select name="visited">
          
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
        <input type="submit" name= "submit">
        </form>
</body>
</html>