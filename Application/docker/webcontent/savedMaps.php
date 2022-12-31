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

    $id = "";
    
    $param_id = $_SESSION["id"];
    // SQL query to select data from database
    $sql = " SELECT * FROM cordinaten Where users_id=?";
    
    $result = $pdo->prepare($sql);
    $result->execute([$param_id]);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['Submit'])){

       
    }}
  
?>

<!doctype html>
<html>
<head>
  <title>Saved Maps</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <th>Visited</th>
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
                        <td>$rows[visited]</td>
                        <td>$rows[added_on]</td>
                        <td>
                            <a class='btn btn-danger btn-sm' href='delete.php?idcordinaten=$rows[idcordinaten]'>Delete</a>
                        </td>

                        <td>
                        <a class='btn btn-danger btn-sm' href='edit.php?idcordinaten=$rows[idcordinaten]'>Edit</a>
                        </td>
                    </tr>
           
            ";
                }
                ?>
            
          </tbody>
      </table>
    </div>


    <!-- TABLE CONSTRUCTION -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>