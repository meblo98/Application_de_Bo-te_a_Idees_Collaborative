<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 require_once "configuration/connection.php";
 session_start();
if (isset($_REQUEST['tache'], $_REQUEST['debut'], $_REQUEST['fin'],$_REQUEST['description'],$_REQUEST['status'])){
  // récupérer les données saissis et supprimer les antislashes ajoutés par le formulaire
  $tache = stripslashes($_REQUEST['tache']);
  $tache = mysqli_real_escape_string($conn, $tache); 
  $debut = stripslashes($_REQUEST['debut']);
  $debut = mysqli_real_escape_string($conn, $debut);
  $fin = stripslashes($_REQUEST['fin']);
  $fin = mysqli_real_escape_string($conn, $fin);
  $status = stripslashes($_REQUEST['status']);
  $status = mysqli_real_escape_string($conn, $status);
  $description = stripslashes($_REQUEST['description']);
  $description = mysqli_real_escape_string($conn, $description);
  $username = $_SESSION['username'];
  //requéte SQL
    $query = "INSERT into `tache` (nom, debut, fin, status,description,username)
              VALUES ('$tache','$debut', '$fin','$status','$description','$username')";
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
<h1 class="box-logo box-title">Ajouter une categorie</h1>
  <input type="text" class="box-input" name="tache" placeholder="nom de la categorie" required /><br/>
  <label for="">Debut</label>
    <input type="date" class="box-input" name="debut" placeholder="date debut" required /><br/>
    <label for="">Fin</label>
    <input type="date" class="box-input" name="fin" placeholder="date fin" required /><br/>
    <input type="text" class="box-input" name="description" placeholder="description" required /><br/>
    <input type="text" class="box-input" name="status" placeholder="status" required /><br/>
    <input type="submit" name="submit" value="Ajouter" class="box-button" />
    <p class="box-register"><a href="index.php">Retourner</a></p>
</form>
</div>

<?php } ?>
</body>
</html>