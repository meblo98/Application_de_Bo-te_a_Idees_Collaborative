<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file
require_once "configuration/connection.php";
 
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    $titre = trim($_POST["titre"]);
    $categorie = trim($_POST["categorie"]);
    $description = trim($_POST["description"]);

        $sql = "UPDATE ideas SET title=?, category=?, description=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_titre, $param_categorie,$param_description ,$param_id);
            
            // Set parameters

            $param_titre = $titre;
            $param_categorie = $categorie;
            $param_description = $description;

            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM ideas WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    
                    $titre = $row["title"];
                    $categorie = $row["category"];
                    $description = $row["description"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <form class="box" action="" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
      <h1 class="box-logo box-title">Modifier l'idées</h1>
      <input type="text" class="box-input" value="<?php echo $titre; ?>" name="titre" placeholder="Titre" required /><br/>
      <input type="text" class="box-input" value="<?php echo $categorie; ?>" name="categorie" placeholder="Categorie" required /><br/>
      <textarea name="description" id="" class="box-textarea" value="<?php echo $description; ?>" placeholder="description" required cols="42" rows="10"></textarea>
      <!-- <input type="text" class="box-input"  name="description" placeholder="description" required /><br/> -->
      <input type="submit" name="submit" value="Modifier" class="box-button" />
      <p class="box-register"><a href="index.php">Retourner</a></p>
    </form>
  </div>
</body>
</html>