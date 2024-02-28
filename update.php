<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file
require_once "configuration/connection.php";
 
// Define variables and initialize with empty values
// $name = $address = $salary = "";
// $name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // // Validate name
    $titre = trim($_POST["titre"]);
    // if(empty($input_name)){
    //     $name_err = "Please enter a name.";
    // } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    //     $name_err = "Please enter a valid name.";
    // } else{
    //     $name = $input_name;
    // }
    
    // // Validate address address
    $categorie = trim($_POST["categorie"]);
    // if(empty($input_address)){
    //     $address_err = "Please enter an address.";     
    // } else{
    //     $address = $input_address;
    // }
    
    // // Validate salary
    $description = trim($_POST["description"]);
    // if(empty($input_salary)){
    //     $salary_err = "Please enter the salary amount.";     
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    // } else{
    //     $salary = $input_salary;
    // }
    
    // Check input errors before inserting in database
    // if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an update statement
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
    // }
    
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
      <input type="text" class="box-input" value="<?php echo $description; ?>" name="description" placeholder="description" required /><br/>
      <input type="submit" name="submit" value="Modifier" class="box-button" />
      <p class="box-register"><a href="index.php">Retourner</a></p>
    </form>
  </div>
</body>
</html>