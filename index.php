<?php
 // Include config file
 require_once "configuration/connection.php";
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: auth/login.php");
    exit(); 
  }

?>
<?php require_once "navbar.php" ?>
    <div class="ideas-list">
        <?php
        // Récupérer et afficher les idées
        $sql = "SELECT * FROM ideas ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<div class='idea'>";
            echo "<h2>{$row['title']}</h2>";
            echo "<p>Catégorie: {$row['category']}</p>";
            echo '<a href="read.php?id='. $row['id'] .'" class="btn btn-primary" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
            echo "</div>";
        }
        ?>
    </div>
