<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "configuration/connection.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM ideas WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $username = $row["username"];
                $titre = $row["title"];
                $categorie = $row["category"];
                $description = $row["description"];
                $dateCreation = $row["data_creation"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Detail</h1>
                    <div class="form-group">
                        <label>Nom d'utilisateur</label>
                        <p><b><?php echo $row["username"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Titre</label>
                        <p><b><?php echo $row["title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Categorie</label>
                        <p><b><?php echo $row["category"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["description"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date de création</label>
                        <p><b><?php echo $row["data_creation"]; ?></b></p>
                    </div>
                    <p>
                        <a href="index.php" class="btn btn-primary">Back</a>
                        <?php
                        echo '<a href="update.php?id='. $row['id'] .'" class="btn btn-primary "><span class="fa fa-pencil"></span>modifier</a>';
                        echo '<a <a href="delete.php?id='. $row['id'] .'"  class="btn btn-danger"><span class="fa fa-trash"></span>Supprimer</a>';
                        ?>
                    </p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>