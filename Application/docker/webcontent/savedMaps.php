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
    
    $param_id = $_SESSION["id"];
    // SQL query to select data from database
    $sql = " SELECT * FROM cordinaten Where users_id=?";
    
    $result = $pdo->prepare($sql);
    $result->execute([$param_id]);
  
?>

<!doctype html>
<html>
<head>
  <title>Saved Maps</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="margin: 50px">

    <div class="container my-5">
        <h2> Saved Locations</h2>
        <a class="btn btn-primary" href="addmaps.php" role="button">Add New Location</a>
        <a class="btn btn-primary" href="welcome.php" role="button">Home</a>
        <br>

        <table class ="table">
          <thead>
            <tr>
                
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Added On</th>

            </tr>
            </thead>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch(PDO::FETCH_ASSOC))
                {
                  echo "
           
                  <tbody>
                    <tr>
                        <!-- FETCHING DATA FROM EACH
                            ROW OF EVERY COLUMN -->
                        <td>$rows[name]</td>
                        <td>$rows[latitude]</td>
                        <td>$rows[longitude]</td>
                        <td>$rows[added_on]</td>
                        <td>
                            <a class='btn btn-danger btn-sm' href='delete.php?idcordinaten=$rows[idcordinaten]'>Delete</a>
                        </td>
                    </tr>
           
            ";
                }
                ?>
            
          </tbody>
      </table>
    </div>
    <!-- TABLE CONSTRUCTION -->
    

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

</body>
</html>