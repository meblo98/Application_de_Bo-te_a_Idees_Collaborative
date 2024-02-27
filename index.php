<?php
 // Include config file
 require_once "configuration/connection.php";
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }

?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>


<ul class="nav justify-content-center nav-fill bg-subtle text-dark nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="ajout.php">ajoutés</a>
  </li>

  <li class="nav-item">
    Dalal jam <?php echo $_SESSION['username']; ?>
  </li>
  <li class="nav-item">
  <a class="nav-link btn btn-primary position-relative" href="auth/logout.php"">Déconnexion</a>
  </li>
</ul>

<div class="ideas-list">
        <?php
        // Récupérer et afficher les idées
        $sql = "SELECT title,category FROM ideas ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<div class='idea'>";
            echo "<h2>{$row['title']}</h2>";
            echo "<p>Catégorie: {$row['category']}</p>";
            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
            echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
            echo "</div>";
        }
        ?>
    </div>
  </body>
</html>