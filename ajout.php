<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
 require_once "configuration/connection.php";
 session_start();
if (isset($_REQUEST['titre'], $_REQUEST['categorie'], $_REQUEST['description'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $titre = stripslashes($_REQUEST['titre']);
  $titre = mysqli_real_escape_string($conn, $titre); 
  // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
  $categorie = stripslashes($_REQUEST['categorie']);
  $categorie = mysqli_real_escape_string($conn, $categorie);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $description = stripslashes($_REQUEST['description']);
  $description = mysqli_real_escape_string($conn, $description);
  $username = $_SESSION['username'];
  //requéte SQL
    $query = "INSERT into `ideas` (username, title, category, description)
              VALUES ('$username','$titre', '$categorie', '$description ')";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>Idées ajoutée avec succès.</h3>
             <p>Cliquez ici pour aller a <a href='index.php'>l'accueil</a></p>
       </div>";
    }
}else{
?>
<div class="container">
<form class="box" action="" method="post">
<h1 class="box-logo box-title">Ajout d'idées</h1>
  <input type="text" class="box-input" name="titre" placeholder="Titre" required /><br/>
    <input type="text" class="box-input" name="categorie" placeholder="Categorie" required /><br/>
    <input type="text" class="box-input" name="description" placeholder="description" required /><br/>
    <input type="submit" name="submit" value="Ajouter" class="box-button" />
    <p class="box-register"><a href="index.php">Retourner</a></p>
</form>
</div>
<?php } ?>
</body>
</html>