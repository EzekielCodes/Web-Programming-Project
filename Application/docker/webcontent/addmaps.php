
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
    $pdo = getDatabase();

    $name = isset($_POST['inputName'])  ? $_POST['inputName'] : ''; ;
    $latitude = isset($_POST['inputlatitude'])  ? $_POST['inputlatitude'] : '';;
    $longitude = isset($_POST['inputlongitude'])  ? $_POST['inputlongitude'] : '';;

    $moduleAction = isset($_POST['moduleAction']) ? (string) $_POST['moduleAction'] : '';

  if($moduleAction == 'processName'){ 
        $param_id = $_SESSION["id"];
        // SQL query to select data from database
        $sql = "INSERT IGNORE INTO cordinaten (name, latitude, longitude,added_on,visited,users_id) VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $latitude,$longitude,(new DateTime())->format('Y-m-d H:i:s'),"No",$param_id]);
        $_SESSION['status'] = "Added Successfully";
      
    }

?>
<!doctype html>
<html>
<head>
  <title>Nominatim-Leaflet</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
</head>
<body style="margin: 50px">
<div class="container pt-5 pb-5">
  <div class="row justify-content-md-center">
    <input name = "search" id="search" style="width: 350px;" type="text">
    <button type="button" class="ml-5 btn btn-primary" id="search-button">Search</button>
    <button type="button" class="ml-5 btn btn-primary" id="save-button">Add to Form</button>
    <a class="ml-5 btn btn-primary"  href='welcome.php'>Home</a>
  </div>

</div>
  
<div class= "row">
  <div class="col-8">  
    <div>
      <div id="map-container" style="height: 75vh;"></div>
    </div>
  </div>

  <div class="col-4">
  <div class="alert alert-danger">
    <strong>Danger!</strong> Don't fill in form just use this as a medium to confirm inputs and click on send to save. Click on Add to Form above.
  </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="inputCityName">Name</label>
        <input type="text" class="form-control" id="inputName"  name = "inputName">
        <small id="nameHelp" class="form-text text-muted">Don't write anything.</small>

        <label for="inputCityLatitude">Latitude</label>
        <input type="text" name = "inputlatitude" class="form-control" id="inputLatitude">

        <label for="inputCityLongitude">longitude</label>
        <input name = "inputlongitude" type="text" class="form-control" id="inputLongitude">


        <input type = "hidden" name= "moduleAction" value="processName" />
        <input type="submit" id = "btnSubmit" class="btn btn-primary" value="Send">
    </form>
    <ul id="result-list"  class="w-75 p-3" ></ul>
   
  </div>
</div>
  
  


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<script src="./app/index.js"></script>
</body>
</html>